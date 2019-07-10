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

function openWindow(url, title) {
	window.open(url, title, "toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600");
}

function ajax(url, callback, form="") {
	var processResponseFunction = function() {
		if (this.readyState == 4 && this.status == 200) {
			callback(this.responseText);
		}
	};

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = processResponseFunction;

	if (form != "") {
		let formData = new FormData(form);
		xmlhttp.open("POST", url, true);
		xmlhttp.send(formData);
	} else {
		xmlhttp.open("GET", url, true);
		xmlhttp.send();
	}
}


// FIXED HEADER
var header = null;

function initStickyHeader(id) {
    header = document.getElementById(id);
    header.style.top = 0;
    header.style.left = 0;
    header.style.right = 0;
}

function stickyHeader() {
    let body = document.getElementById("parent-div");
    // console.log(window.scrollY, header.offsetTop);
    // console.log(header.offsetHeight);

    /*header.offsetTop*/

    if (window.scrollY >= 0) {
        header.style.position = "fixed";
        body.style.paddingTop = header.offsetHeight + "px";
    } else {
        header.style.position = "relative";
        body.style.paddingTop = 0;
    }
}
window.addEventListener("scroll", stickyHeader);