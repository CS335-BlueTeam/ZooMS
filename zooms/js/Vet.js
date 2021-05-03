let showNewAnimalRecordForm = document.getElementById('newAnimalForm');
let showUpdateAnimalRecordForm = document.getElementById('updateAnimalForm');
let showAllNutritionRecords = document.getElementById('allNutritionRecords');


window.onload = function() {
	showNewAnimalRecordForm.style.display = 'none';
	showUpdateAnimalRecordForm.style.display = 'none';
	showAllNutritionRecords.style.display = 'none';
}

let addNewAnimalButton = document.getElementById('addNewAnimalRecordButton');
addNewAnimalButton.addEventListener("click", function() {
	showNewAnimalRecordForm.style.display = 'flex';
	showUpdateAnimalRecordForm.style.display = 'none';
	showAllNutritionRecords.style.display = 'none';

	document.getElementById('submitNewAnimalRecord').name = "submitNewRecord";
});

let updateAnimalDietButton = document.getElementById('updateDietButton');
updateAnimalDietButton.addEventListener("click", function() {
	showUpdateAnimalRecordForm.style.display = 'flex';
	showNewAnimalRecordForm.style.display = 'none';
	showAllNutritionRecords.style.display = 'none';
	document.getElementById('submitUpdateAnimalRecord').name = "submitUpdateRecord";
});

let showAllNutritionButton = document.getElementById('viewAllNutritionRecordButton');
showAllNutritionButton.addEventListener("click", function() {
	showAllNutritionRecords.style.display = 'flex';
	showNewAnimalRecordForm.style.display = 'none';
	showUpdateAnimalRecordForm.style.display = 'none';
	
});
