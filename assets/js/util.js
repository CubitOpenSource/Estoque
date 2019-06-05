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