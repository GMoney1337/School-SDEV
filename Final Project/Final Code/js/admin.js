//  FILE: admin.js
//  DATE: 11/28/2017
//  PROJECT TEAM: Alexander DeForge, Douglas Evert, Pierre Lucceus, Galen Yanofsky
//  REVISION TABLE:
//	Alexander DeForge::dynamic webpage functionality (initial)
// 	Alexander DeForge::POST functionality to php scripts (12/5/2017)
//	Alexander DeForge:: wrote functions to handle PHP output (12/6)
// 	Alexander DeForge:: added proper JSON support (12/8)
// 	Alexander DeForge:: consolidated functionality (12/8)
//  Alexander DeForge :: added support for search_handler.php, remove_handler.php, add_handler.php, admin_update_handler.php, and  the putInfo() function (12/14)
// PURPOSE: support dynamic content on Admin webpage,
//    also contains JSON object creation function  

var list_element_identifier = 1;
var parseable = ["names", "phones", "addresses", "salaries", "ptobalances", "demographics", "notes"]
var selected_result = null;

// the initial buttons have both add/"+" and remove/"-" buttons (but the "-" button does not remove the initial input text field)
function initialize() {
	var addButtons = document.getElementsByClassName("add");
	for (var i = 0; i < addButtons.length; i++) {
		addButtons[i].onclick = appendItem;
	}
	var removeButtons = document.getElementsByClassName("remove");
	for (var i = 0; i < removeButtons.length; i++) {
		removeButtons[i].onclick = removeItem(null);
	}
	document.getElementById("search_button").onclick = search;
	document.getElementById("remove_button").onclick = remove;
	document.getElementById("update_button").onclick = update;
	document.getElementById("add_button").onclick = add;
	window.onbeforeunload = function() {  window.alert("here");};
	return false;
}

// adds an input text field with a remove/"-" button bound to 'removeItem()'
function appendItem(that) {
	var target = null;
	if (that["target"] != null) {
		target = that["target"].parentNode.parentNode;
	} else {
		target = that;
	}
	var fragment = document.createElement('li');
	fragment.classList.add("list-group-item");
	var list_element = "<input type='text' class='form-control' value=''><a class='btn btn-secondary remove' role='button' href='#' onclick='removeItem(" + list_element_identifier + "); return false;'>-</a>";
	fragment.id = list_element_identifier++;
	fragment.innerHTML = list_element;
	target.prepend(fragment);
	return false;
}

// remove the list item with the clicked remove/"-" button
function removeItem(identifier=null) {
	if (identifier != null && identifier != "") {
		var target = document.getElementById(identifier);
		target.parentNode.removeChild(target);
	}
	return false;
}

// aggregate information from search form and return results
function search() {
	var search_terms = getInfo("search");
	$(".disposable").remove();
	$.post('http://ec2-52-90-44-3.compute-1.amazonaws.com/php/search_handler.php',search_terms,appendResult);
	return false;
}
// remove entry from database
function remove() {
	if (confirm("Remove selected entry?")) {
		if (selected_result != null) {
			$.post("http://ec2-52-90-44-3.compute-1.amazonaws.com/php/remove_handler.php",selected_result.id,function(result) {
				if (result) {
					selected_result.remove();
				} else {
					window.alert("Error removing");
				}
			});
		}
	} else {
	}
	return false;
}
// update entry in database
function update() {
	if (confirm("Update selected entry?")) {
		var update_info = getInfo("write");	
		update_info["id"] = selected_result.id;
		$.post('http://ec2-52-90-44-3.compute-1.amazonaws.com/php/admin_update_handler.php',update_info, function(result) { 
			if (result) {
				window.alert("Update successful");
			} else {
				window.alert("Error updating");
			}	
		});
	} else {
	}
	return false;
}
// add entry to database
function add() {
	if (confirm("Add entry?")) {
		var new_entry = getInfo("write");
		$.post('http://ec2-52-90-44-3.compute-1.amazonaws.com/php/add_handler.php',new_entry, function(result) { 
			if (result) {
				window.alert("Add successful");
			} else {
				window.alert("Error adding");
			}
		});
	} else {
	}
	return false;
}
// used by the search() function
// stores name and id pairs for getting full data from database
// database id is stored as <a> element id
function appendResult(data) {
	var target = document.getElementById("results");
	var i = 0;
	data = JSON.parse(data);
	while(data[i] != null) {
		var dat = data[i];
		if (dat["name"] != "" && dat["employeeID"] != "") {
			var element = document.createElement('a');
			element.classList.add("disposable");
			element.classList.add("list-group-item");
			element.classList.add("list-group-item-action");
			element.innerHTML = dat["name"];
			element.id = dat["employeeID"];
			target.appendChild(element);
		}
		i++;
	}
	// for each result appended...
	$('a.list-group-item').on('click',function() {
		if (selected_result === null || selected_result.id != this.id) {
			selected_result = this;
			$.post("http://ec2-52-90-44-3.compute-1.amazonaws.com/php/display_handler.php",{"id":selected_result.id},putInfo);
		}
	});
	return false;
}
// populate right third of admin page (display area) when result name is clicked via display_handler.php
function putInfo(data) {
	data = JSON.parse(data);
	for (var token in data[0]) {
		var tok = "";
		if (token === "name") {
			tok = "names";
		} else if (token === "phone") {
			tok = "phones";
		} else if (token === "address") {
			tok = "addresses";
		} else if (token === "salaries") {
			tok = token;
		} else if (token === "daysPTO") {
			tok = "ptobalances";
		} else {
			continue;
		}
		var search = "#write ul." + tok;
		var target = $(search);
	
		if (tok === "ptobalances" || tok === "salaries") {
			var text = data[0][token];
			if (text != undefined) {
				target[0]['children'][0]['children'][0]['value'] = text;
			}
		} 
	
		for (var i = 0; i < target.length; i++) {
			removeItem(target[0]['children'][i].id);
		}
		for (var i = 1; i < target[0]['children'].length; i++) {
			appendItem(target);	
		}
		for (var i = 0; i < target[0]['children'].length; i++) {
			var text = data[0][token];
			if (text === undefined) {
				text = "";
			}
			target[0]['children'][i]['children'][0]['value'] = text;	
		}
	}	
}

// parses the webpage to gather information from dynamic list elements and creates JSON string
function getInfo(targetID) {
	// targetID is either "search" or "write", for the search fields or update/add, respectively 
	//    (the "read"/center third/results section is handled with a different function)
	var target = document.getElementById(targetID);
	var fields = {}	 
	for (var i = 0; i < parseable.length; i++) {
		fields[parseable[i]] = [];
	}

	// parse through relevant text input fields and populate dictionary with corresponding field title key (array contains associated values)
	var i = 0;
	var max_field_length = 0;
	for (token in fields) {
		if (token === "ptobalances" || token === "salaries") {
			var range_group = target.getElementsByClassName(token)[0];
			var group = range_group.getElementsByTagName('input'); 
			var range;
			if (group[1] != null) {
				range = [group[0].value,group[1].value];
			} else {
				range = [group[0].value,""];
			}
			fields[token].push(range);
		} else {
			var list_group = target.getElementsByClassName(token);
			var group = list_group[0];
			var list = group.getElementsByTagName('li');
			for (var j = 0; j < list.length; j++) {
				fields[token].push(list[j]['children']['0']['value']);
			}	
			if (list.length > max_field_length) {
				max_field_length = list.length;
			}
		}
	}
	return fields; 
}

window.onload = initialize();
