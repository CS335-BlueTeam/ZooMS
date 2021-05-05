<?php
echo file_get_contents("../html/header.php");
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $_SESSION['message'] = "Access Denied.";
    $_SESSION['msg_type'] = "danger";
    header("location: welcome.php");
    exit;
}
$myRoot = $_SERVER["DOCUMENT_ROOT"];

// Include connection file
require_once ($myRoot . '/ZooMS/zooms/db/connect_to_db.php');
$conn = get_db_connection();

// Define variables and initialize with empty values
$employee_id = $password = "";
$employee_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 /**************************
  * 
  * Form error Handling 
  *
  * start
  *
  *
  *************************/
    // Check if employee_id is empty
    if(empty(trim($_POST["employee_id"]))){
        $employee_err = "Please enter employee id.";
    } else{
        $employee_id = intval(trim($_POST["employee_id"]));
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    /******************************
     * 
     * end
     * 
     *******************************/
    
    // Validate credentials
    if(empty($employee_err) && empty($password_err)){

        // Prepare a select statement
        $sql = "SELECT ID, password, fname, dept_name FROM employees WHERE ID = ?";

        if($result = sqlsrv_query($conn, $sql, array($employee_id))){
            if(sqlsrv_has_rows($result)){ 
                if($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                    
                    // can change to password_verify($password, $row['password'])
                    // to verify hashed passwords
                    if(password_verify($password, $row['password'])){
                        // Password is correct, so start a new session
                        session_start();

                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["employee_id"] = $employee_id;
                        $_SESSION["employee_name"] = $row['fname'];
                        $_SESSION["department"] = $row['dept_name'];

                        // Redirect user to welcome page
                        header("location: welcome.php");
                    } else{
                        // Password is not valid, display a generic error message
                        $login_err = "Invalid employee_id or password.";
                    }
                }
            } else{
                // employee_id doesn't exist, display a generic error message
                $login_err = "Invalid employee_id or password.";
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
            die( print_r( sqlsrv_errors(), true));
        }

        // Close statement
        sqlsrv_free_stmt($result);
    }
    
    // Close connection
    sqlsrv_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <!-- Forms for user input -->
        <!-- html special chars prevent XSS hacking -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>employee_id</label>
                <input type="text" name="employee_id" class="form-control <?php echo (!empty($employee_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $employee_id; ?>">
                <span class="invalid-feedback"><?php echo $employee_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
</body>
</html>