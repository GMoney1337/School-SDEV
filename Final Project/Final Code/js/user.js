// FILE: user.js
// PROJECT TEAM: Alexander DeForge, Douglas Evert, Pierre Lucceus, Galen Yanofsky
// DATE: 11/28/2017
// AUTHOR(revision table): 
// Alexander DeForge::dynamic webpage functionality (initial)
// ::POST functionality to php scripts (12/5/2017)
// Alexander DeForge :: putInfo() method, implemented user_check.php (12/14)
// PURPOSE: support dynamic content on Admin webpage,
// also contains JSON object creation function  

var list_element_identifier = 0;

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
	document.getElementById("update_button").onclick = update;
	$.post("http://ec2-52-90-44-3.compute-1.amazonaws.com/php/user_check.php",{"non":"sense"},putInfo);
	return false;
}

// adds an input text field with a remove/"-" button bound to 'removeItem()'
function appendItem() {
	var target = this.parentNode.parentNode;
	var fragment = document.createElement('li');
	fragment.classList.add("list-group-item");
	var list_element = "<input type='text' class='form-control'><a class='btn btn-secondary remove' href='#' role='button' onclick='removeItem(" + list_element_identifier + "); return false;'>-</a>";
	fragment.id = list_element_identifier++;
	target.prepend(fragment);
	fragment.innerHTML = list_element;
	return false;
}

// remove the list item with the clicked remove/"-" button
function removeItem(identifier=null) {
	if (identifier != null) {
		var target = document.getElementById(identifier);
		target.parentNode.removeChild(target);
	}
	return false;
}
// the database does not currently support demographics
function update() {
	if (confirm("Update your demographics?")) {
		var demographics = getInfo("demographics");	
		$.post('http://ec2-52-90-44-3.compute-1.amazonaws.com/php/user_update_handler.php',demographics, function(result) { 
			console.log(result);
		});
		console.log("update successful.");
	} else {
	}
	return false;
}

// populate page with information based upon the logged in user via a call to user_check.php on load
function putInfo(info) {
	if (info == null) {
		return;
	}
	info = JSON.parse(info);
	for (var token in info[0]) {
		var tok = null;
		if (token === "name") {
			tok = "names";
		} else if (token === "phone") {
			tok = "phones";
		} else if (token === "address") {
			tok = "addresses";
		} else if (token === "salaries") {
			tok = "salaries";
		} else if (token === "daysPTO" ) {
			tok = "ptobalances";
		} else {
			continue;
		}

		var target = document.getElementsByClassName(tok);
		target[0]['children'][0]['children'][0]['value'] = info[0][token];
		console.log(target);	
	}	
}
// parses the webpage to gather information from dynamic list elements and creates JSON string
function getInfo(targetID) {
	// targetID is either "search" or "write", for the search fields or update/add, respectively 
	//    (the "read"/center third/results section is handled with a different function)
	var target = document.getElementById(targetID);
	var fields = {"demographics": []};

	// parse through relevant text input fields and populate dictionary with corresponding field title key (array contains associated values)
	var list_elements = target.getElementsByTagName("li");
	for (var i = 0; i < list_elements.length; i++) {
		fields["demographics"].push(list_elements[i]['children']['0']['value']);
	}	

	return fields; 
}

window.onload = initialize();
