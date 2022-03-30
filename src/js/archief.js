let checkButton = document.querySelector('input#showOnly');
checkButton.addEventListener('click', () => {
    if (!checkButton.checked) {
        window.location.href = "./archief.php?showOnly=0";
    } else {
        window.location.href = "./archief.php?showOnly=1";
    }
});

document.querySelectorAll('input.addToMain').forEach((addButton) => {
	addButton.addEventListener('click', () => {
		let linkInfo = "";
		if (window.location.search) {
			linkInfo = window.location.search.substring(1) + "&";
		}
		window.location.href = "../includes/mainpageaddition.inc.php?" + linkInfo + "id=" + addButton.id.substring(10) + "&checked=" + addButton.checked;
	})
})

