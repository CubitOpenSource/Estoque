let callback = function(response) {
	// alert("Server says: " + response);
	// document.getElementById("unity-submit").disabled = false;
	if (response == "success") closeModal();
};

function callAjax(e) {
	// e.preventDefault();

	if (this) {
		var url = document.getElementById("script-url").value;
		var form = document.getElementById("unity-form");
		// document.getElementById("unity-submit").disabled = true;
		ajax(url, form, callback);
	}
}