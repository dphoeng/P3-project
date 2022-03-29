let dropdownEls = document.querySelectorAll("div.dropdown");
let selectEls = document.querySelectorAll("div.default-select");

// open dropdown menu when clicked
dropdownEls.forEach((dropdownEl) => {
    dropdownEl.addEventListener("click", () => {
        let optionsEl = dropdownEl.querySelector("div.options");
        optionsEl.style.display = optionsEl.style.display === "flex" ? "none" : "flex";
    })
});

// function for closing dropdown menu when clicked away
document.addEventListener("click", (event) => {
    dropdownEls.forEach((dropdownEl) => {
        if (!dropdownEl.contains(event.target))
        {
            let optionsEl = dropdownEl.querySelector("div.options");
            optionsEl.style.display = "none";
        }
    })
})

function select(text, id) {
	document.querySelector("div#" + id + " div.default-select a").innerHTML = text;
}

function submit(id) {
    window.location.href = "../includes/updaterole.inc.php?id=" + id + "&role=" + document.querySelector("div#dropdownId" + id + " div.default-select a").innerHTML.toLowerCase();
}
