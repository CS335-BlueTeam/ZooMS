let showNewForm = document.getElementById('form');
let showUpdateForm = document.getElementById('updateForm');
let showEmployeesForm = document.getElementById('allEmployeeRecords');


window.onload = function() {
	showNewForm.style.display = 'none';
	showUpdateForm.style.display = 'none';
	showEmployeesForm.style.display = 'none';
	document.getElementById("dashboard-pill").click();

}

let addNewEmployeeButton = document.getElementById('addNewEmployeeButton');
addNewEmployeeButton.addEventListener("click", function() {
	showNewForm.style.display = 'flex';
	showUpdateForm.style.display = 'none';
	showEmployeesForm.style.display = 'none';
});

let updateEmployeeButton = document.getElementById('updateEmployeeButton');
updateEmployeeButton.addEventListener("click", function() {

	showUpdateForm.style.display = 'none';
	showEmployeesForm.style.display = 'flex';
	showEmployeesForm.scrollIntoView(true);
	showNewForm.style.display = 'none';
});

let updateEmployee = document.getElementsByClassName('editEmployeeButtons');
for (let i = 0; i < updateEmployee.length; i++) {
	updateEmployee[i].addEventListener('click', function () {
		showUpdateForm.style.display='flex';
		showNewForm.style.display='none';
		showUpdateForm.scrollIntoView(true);

	});
};
