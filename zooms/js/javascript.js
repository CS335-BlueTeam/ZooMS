let showNewForm = document.getElementById('form');
let showUpdateForm = document.getElementById('updateForm');


window.onload = function() {
	showNewForm.style.display = 'none';
	showUpdateForm.style.display = 'none';

}

let addNewEmployeeButton = document.getElementById('addNewEmployeeButton');
addNewEmployeeButton.addEventListener("click", function() {
	showNewForm.style.display = 'flex';
	showUpdateForm.style.display = 'none';
	document.getElementById('submitNewEmployeeRecord').name = "submitNewEmployeeRecord";
});

let updateEmployeeButton = document.getElementById('updateEmployeeButton');
updateEmployeeButton.addEventListener("click", function() {
	showUpdateForm.style.display = 'flex';
	showNewForm.style.display = 'none';
	document.getElementById('submitUpdateEmployeeRecord').name = "submitUpdateEmployeeRecord";
});
