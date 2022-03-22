function scrollToCards(anchor) {
	const id = document.querySelector(anchor);
	const navBarHeight = document.querySelector('nav').clientHeight;
	if (document.querySelector('nav div.menu').classList.contains('is-active')) {
		navBarToggle();
	}
	scrollTo({left: 0, top: id.offsetTop - navBarHeight, behavior: 'smooth'});
}