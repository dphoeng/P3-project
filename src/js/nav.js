const menuButton = document.querySelector('header button.hamburger');
menuButton.addEventListener('click', navBarToggle);

function navBarToggle () {
	document.querySelector('nav div.menu').classList.toggle('is-active');
    menuButton.classList.toggle('is-active');
    document.body.style.overflowY = document.body.style.overflowY === 'hidden' ? 'auto' : 'hidden';
}