function toggleSelectRow(row) {
	if (this) {
		if (this.className == "") {
			this.setAttribute("class", "selected");
			this.getElementsByClassName("checkbox")[0].setAttribute("checked", "true");
			toggleOptions();
		} else {
			this.removeAttribute("class");
			this.getElementsByClassName("checkbox")[0].removeAttribute("checked");
			toggleOptions();
		}
	}
}

function toggleSelectCheckboxes(source) {
	var checkboxes = document.querySelectorAll('input[type="checkbox"]');
	for (var i = 0; i < checkboxes.length; i++) {
	    if (checkboxes[i] != source) {
	        checkboxes[i].checked = source.checked;

	        // bug below

	        var parent = checkboxes[i].parentElement.parentElement;
	        // alert(checkboxes[i].checked + " " +parent.className);
	        if (parent) {
	        	if (parent.className == "") {
	        		if (checkboxes[i].checked) {
	        			parent.setAttribute("class", "selected");
	        		}		        		
	        	} else {
	        		parent.removeAttribute("class");
	        	}
	        }
	    }
	}
}

function toggleOptions() {
	var d = document.getElementById("delete-selected");

	if (d.style.visibility != "visible") {
		d.style.visibility = "visible";
	} else {
		d.style.visibility = "hidden";
	}
}

function deleteAllProducts(baseUrl) {
	var rows = document.getElementById("products-tbody").getElementsByTagName("tr");
	var ids = "";
	var count = 0;
	for (var i = 0; i < rows.length; i++) { 
		var cb = rows[i].querySelector('input[type="checkbox"');
		var id = rows[i].querySelector('input[type="hidden"').value;

		if (cb.checked) {
			ids += id + "-";
			count++;
		}
	}
	if (ids != "") {
		var msg = "A operação apagará " + count + " produto";
		msg += (count <= 1) ? "" : "s";
		msg += ". Deseja continuar?";

		if (confirm(msg) == 1) {
			window.location.href = baseUrl + "products/delete/" +ids;
		}
	}
}