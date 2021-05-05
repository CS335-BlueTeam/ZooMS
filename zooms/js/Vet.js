let updateNutritionForm = document.getElementById('update');
let showNewDietForNewAnimalForm = document.getElementById('dietForNewAnimalForm');
let showAllNutritionRecords = document.getElementById('allNutritionRecords');


window.onload = function() {
	showNewDietForNewAnimalForm.style.display = 'none';
	showAllNutritionRecords.style.display = 'none';
	updateNutritionForm.style.display='none';
	document.getElementById("dashboard-pill").click();

}

let showAllNutritionButton = document.getElementById('viewAllNutritionRecordButton');
showAllNutritionButton.addEventListener("click", function() {
	if (showAllNutritionRecords.style.display === "none"){
		showAllNutritionRecords.style.display='flex';
	} else {
		showAllNutritionRecords.style.display = 'none';
		updateNutritionForm.style.display='none';
		showNewDietForNewAnimalForm.style.display='none';
	}

	
});

let updateNutrition = document.getElementsByClassName('editButtons');
for (let i = 0; i < updateNutrition.length; i++) {
	updateNutrition[i].addEventListener('click', function () {
		updateNutritionForm.style.display='flex';
		showNewDietForNewAnimalForm.style.display='none';
		updateNutritionForm.scrollIntoView(false);

	});
};

let addNutrition = document.getElementsByClassName('addButtons');
for (let i = 0; i < addNutrition.length; i++) {
	addNutrition[i].addEventListener('click', function () {
		showNewDietForNewAnimalForm.style.display='flex';
		updateNutritionForm.style.display='none';
		showNewDietForNewAnimalForm.scrollIntoView(true);
	});
}

