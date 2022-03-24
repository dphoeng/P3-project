function confirmPopup(link, message) {
	if (confirm(message)) {
        window.location.href = link;
	}
}