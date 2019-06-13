function updatePreviewImage() {
	if (this.files && this.files[0]) {
		var obj = new FileReader();
		obj.onload = function(data) {
			var image = document.getElementById("image-preview");
			image.setAttribute("src", data.target.result);
			if (image.style.display == "none") image.style.display = "block";
		};
		obj.readAsDataURL(this.files[0]);
	}
}

function selectAll() {
	if (this) {
		this.selectionStart = 0;
		this.selectionEnd = this.value.length;
	}
}

function ajax(url, formName, callback) {
	var processResponseFunction = function() {
		if (this.readyState == 4 && this.status == 200) {
			callback(this.responseText);
		}
	};

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = processResponseFunction;
	xmlhttp.open("POST", url, true);

	if (formName !== null) {
		let formData = new FormData(formName);
		xmlhttp.send(formData);
	} else {
		xmlhttp.send();
	}
}