function openModal(event, url) {
	if (event) { event.preventDefault(); }
	var modalBox = document.getElementById("modal-bg");
	var modal = document.getElementById("modal");

	var callback = function(response) {
		modal.innerHTML = response;
		modalBox.style.display = "block";
		modalBox.getElementsByTagName("form")[0].getElementsByTagName("input")[0].focus();
	};

	ajax(url, callback);
}

function closeModal(event) {
	if (event) event.preventDefault();
	var modalBox = document.getElementById("modal-bg");
	modalBox.style.display = "none";
}

window.onload = function() {
	document.getElementById("close-modal").addEventListener("click", closeModal, 1);
	var options = document.getElementsByClassName("btn-option");

	for (var i = 0; i < options.length; i++) {
		options[i].addEventListener("click", function(event) { openModal(event, this.getAttribute("href")); }, 1);
	}
}