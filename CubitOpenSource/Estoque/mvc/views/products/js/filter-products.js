var fName = false;
var fStock = false;
var fCategory = false;

var listName = [];
var listStock = [];
var listCat = [];

function showVariables() {
	/*console.log("Filters:");
	console.log("Name -> " + fName);
	console.log("Stock -> " + fStock);
	console.log("Category -> " + fCategory);
	console.log("------------------------------");
	console.log("Lists:");
	console.log("lName " + listName.length);
	console.log("lStock " + listStock.length);
	console.log("lCategory " + listCat.length);
	console.log("------------------------------");*/
}

function findTableDataByType(tr, type) {
	if (typeof undefined == typeof tr) return null;
    let tds = tr.getElementsByTagName("td");
    for (let j = 0; j < tds.length; j++) {
        if (tds[j].getAttribute("data-type") == type) {
            let div = tds[j].getElementsByTagName("div")[0];
            if (div && typeof div.getAttribute("data-type") != typeof undefined) {
                return div;
            }
            return tds[j];
        }
    }
    return null;
}

function getFilterList(type, callback) {
	let list = [];
    let tr = document.getElementById("products-tbody").getElementsByTagName("tr");
    

    for (let i = 0; i < tr.length; i++) {
        let td = findTableDataByType(tr[i], type);
        if (td && td != null && typeof td != typeof undefined) {
            let value = td.textContent || td.innerText;
            if (callback(value)) list.push(tr[i]);
        }
    }
    switch(type) {
    	case "description":
    		listName = list; break;
    	case "category":
    		listCat = list; break;
    	case "stock":
    		listStock = list; break;
    	default:
    		return false;
    }
    showVariables();
    filter();
}

function inArray(value, array) {
	let tr = array;
	for (var i = 0; i < tr.length; i++) {
		// if (tr[i].style.display != "") continue;
		let td = findTableDataByType(tr[i], "id");
		let v = (td.textContent || td.innerText);

		// console.log(v + " ? " + value);
		if (v == value) return true;
	}
}

function filter() {
	let list = [];
	let tr = document.getElementById("products-tbody").getElementsByTagName("tr");
	
	if (fName && fStock && fCategory) {
		for (var i = 0; i < tr.length; i++) {
			let td = findTableDataByType(tr[i], "id");
			let id = (td != null) ? (td.textContent || td.innerText) : "";
			if (id == "") continue;

			if (inArray(id, listName) && inArray(id, listStock) && inArray(id, listCat)) {
				list.push(tr[i]);
			}
		}
	} else if (fName && fStock) {
		for (var i = 0; i < tr.length; i++) {
			let td = findTableDataByType(tr[i], "id");
			let id = (td != null) ? (td.textContent || td.innerText) : "";
			if (id == "") continue;

			if (inArray(id, listName) && inArray(id, listStock)) {
				list.push(tr[i]);
			}
		}
	} else if (fName && fCategory) {
		for (var i = 0; i < tr.length; i++) {
			let td = findTableDataByType(tr[i], "id");
			let id = (td != null) ? (td.textContent || td.innerText) : "";
			if (id == "") continue;

			if (inArray(id, listName) && inArray(id, listCat)) {
				list.push(tr[i]);
			}
		}
	} else if (fStock && fCategory) {
		for (var i = 0; i < tr.length; i++) {
			let td = findTableDataByType(tr[i], "id");
			let id = (td != null) ? (td.textContent || td.innerText) : "";
			if (id == "") continue;

			if (inArray(id, listStock) && inArray(id, listCat)) {
				list.push(tr[i]);
			}
		}
	} else if (fName) {
		for (var i = 0; i < tr.length; i++) {
			let td = findTableDataByType(tr[i], "id");
			let id = (td != null) ? (td.textContent || td.innerText) : "";
			if (id == "") continue;

			if (inArray(id, listName)) {
				list.push(tr[i]);
			}
		}
	} else if (fStock) {
		for (var i = 0; i < tr.length; i++) {
			let td = findTableDataByType(tr[i], "id");
			let id = (td != null) ? (td.textContent || td.innerText) : "";
			if (id == "") continue;

			if (inArray(id, listStock)) {
				list.push(tr[i]);
			}
		}
	} else if (fCategory) {
		for (var i = 0; i < tr.length; i++) {
			let td = findTableDataByType(tr[i], "id");
			let id = (td != null) ? (td.textContent || td.innerText) : "";
			if (id == "") continue;

			if (inArray(id, listCat)) {
				list.push(tr[i]);
			}
		}
	} else {
		list = tr;
	}

	// Filter with current list
	for (var i = 0; i < tr.length; i++) {
		let td = findTableDataByType(tr[i], "id");
		let id = (td != null) ? (td.textContent || td.innerText) : "";
		if (id == "") continue;
		tr[i].style.display = (inArray(id, list)) ? "" : "none";
	}
}

function filterByName(clear=false) {
	let query = document.getElementById("filter-name");
    query.value = (clear) ? "" : query.value;
    let clr = document.getElementById("clear-name-filter");
	clr.style.display = (query.value != "") ? "inline-block" : "none";
    let callback = function(value) {
    	let index = value.toUpperCase().indexOf(query.value.toUpperCase());
    	return (index > -1) ? true : false;
    };
    fName = (query.value == "") ? false : true;
    getFilterList("description", callback);
}

function filterByCategory(name) {
	let clr = document.getElementById("clear-category-filter");
	clr.style.display = (name != "0") ? "inline-block" : "none";

    if (name == "0") {
        document.getElementById("filter-category").selectedIndex = 0;
    }
    let callback = function(value) {
    	return (name == "-1" &&  value == "") ? true : ((name == value || name == "0") ? true : false);
    };
    fCategory = (name == "0") ? false : true;
    getFilterList("category", callback);
}

function filterByStock(mode) {
	let clr = document.getElementById("clear-stock-filter");
	clr.style.display = (mode != 0) ? "inline-block" : "none";
    if (mode == 0) {
        document.getElementById("filter-stock").selectedIndex = 0;
    }

    let minStock = 2;
    let callback = function(value) {
        if (mode == 1) {
            return (value <= minStock) ? true : false;
        } else if (mode == 2) {
            return (value > minStock) ? true : false;
        } else {
            return true;
        }
    };
    fStock = (mode == 0) ? false : true;
    getFilterList("stock", callback);
}