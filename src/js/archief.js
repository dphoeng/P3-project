let checkButton = document.querySelector('input#showOnly');
checkButton.addEventListener('click', function () {
    if (!checkButton.checked) {
        window.location.href = "./archief.php?showOnly=0";
    } else {
        window.location.href = "./archief.php?showOnly=1";
    }
});