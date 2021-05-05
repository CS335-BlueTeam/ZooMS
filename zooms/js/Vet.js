let updateNutritionForm = document.getElementById('update');
let showNewAnimalRecordForm = document.getElementById('newAnimalForm');

let showAllNutritionRecords = document.getElementById('allNutritionRecords');


window.onload = function() {
	showNewAnimalRecordForm.style.display = 'none';

	showAllNutritionRecords.style.display = 'none';
	updateNutritionForm.style.display='none';

}

let addNewAnimalButton = document.getElementById('addNewAnimalRecordButton');
addNewAnimalButton.addEventListener("click", function() {
	// showNewAnimalRecordForm.style.display = 'flex';

	showAllNutritionRecords.style.display = 'none';

	document.getElementById('submitNewAnimalRecord').name = "submitNewRecord";
});


let showAllNutritionButton = document.getElementById('viewAllNutritionRecordButton');
showAllNutritionButton.addEventListener("click", function() {
	if (showAllNutritionRecords.style.display === "none"){
		showAllNutritionRecords.style.display='flex';
		// showNewAnimalRecordForm.style.display = 'none';

	} else {
		showAllNutritionRecords.style.display = 'none';
		// showNewAnimalRecordForm.style.display = 'none';
	}

	
});

let updateNutrition = document.getElementsByClassName('editButtons');
for (let i = 0; i < updateNutrition.length; i++) {
	updateNutrition[i].addEventListener('click', function () {
		updateNutritionForm.style.display='flex';
	});
}
