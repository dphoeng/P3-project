function scrollToCards(anchor) {
	const id = document.querySelector(anchor);	
	let vh = window.innerHeight * 0.01;
	if (document.querySelector('nav div.menu').classList.contains('is-active')) {
		navBarToggle();
	}
	scrollTo({left: 0, top: id.offsetTop - 16 * vh, behavior: 'smooth'});
}