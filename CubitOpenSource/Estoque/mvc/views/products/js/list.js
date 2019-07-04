function toggleSelectRow(row) {
	var src = (row) ? row : this;
	if (src) {
		if (src.className == "") {
			src.setAttribute("class", "selected");
		} else {
			src.removeAttribute("class");
		}
		var cb = src.getElementsByClassName("checkbox")[0];
		cb.checked = (src.className == "selected") ? true : false;
		cb.style.visibility = (src.className == "selected") ? "visible" : "hidden";
		toggleOptions();
	}
}

function setSelectRow(src, value) {
	src = (src) ? src : this;
	if (src) {
		if (value) {
			src.setAttribute("class", "selected");			
		} else {
			src.removeAttribute("class");
		}
		var cb = src.getElementsByClassName("checkbox")[0];
		cb.checked = value;
		cb.style.visibility = (value) ? "visible" : "hidden";
	}
}

function toggleSelectCheckboxes(source) {
	var cbs = document.getElementById("products-tbody").getElementsByClassName("checkbox");
	for (var i = 0; i < cbs.length; i++) {
		setSelectRow(cbs[i].parentElement.parentElement, source.checked);
	}
	toggleOptions();

	var count = 0;
	var label = document.getElementById("toggle-select-label");
	for (var i = 0; i < cbs.length; i++) {
		count += (cbs[i].checked) ? 1 : 0;
	}
	label.innerHTML = (count > 0) ? "Desmarcar Tudo" : "Marcar Tudo";
}

function selectAllCheckboxes(source, value = null) {
	var cbs = document.getElementById("products-tbody").getElementsByClassName("checkbox");
	source.checked = (value != null) ? value : source.checked;
	for (var i = 0; i < cbs.length; i++) {
		setSelectRow(cbs[i].parentElement.parentElement, source.checked);
	}
	toggleOptions();

	var count = 0;
	var label = document.getElementById("toggle-select-label");
	for (var i = 0; i < cbs.length; i++) {
		count += (cbs[i].checked) ? 1 : 0;
	}
	label.innerHTML = (count > 0) ? "Desmarcar Tudo" : "Marcar Tudo";
}

function toggleOptions() {
	var cbs = document.getElementById("products-tbody").getElementsByClassName("checkbox");
	var d = document.getElementById("delete-selected");
	var count = 0;

	for (var i = 0; i < cbs.length; i++) {
		count += (cbs[i].checked) ? 1 : 0;
	}

	d.style.visibility = (count > 0) ? "visible" : "hidden";
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

function filterByName() {
	var filter = document.getElementById("filter-name").value.toUpperCase();
	var tr = document.getElementById("products-tbody").getElementsByTagName("tr");

	for (let i = 0; i < tr.length; i++) {
		let td = tr[i].getElementsByTagName("td")[2];
		if (td) {
			let value = td.textContent || td.innerText;
			tr[i].style.display = (value.toUpperCase().indexOf(filter) > -1) ? "" : "none";
		}
	}

	selectAllCheckboxes(document.getElementById("select-all"), false);
}