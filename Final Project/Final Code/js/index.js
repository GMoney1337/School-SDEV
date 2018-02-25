// FILE: index.js
// DATE: 12/7/2017
// PROJECT TEAM: Alexander DeForge, Douglas Evert, Pierre Lucceus, Galen Yanofsky
// REVISION TABLE:
// Alexander DeForge :: login() (12/7)
// Alexander DeForge :: redirected post to authentication.php from admin_check.php and user_check.php (12/13)
// Alexander DeForge :: implemented authentication.php functionality (12/14)
// PURPOSE: handle login for index.html
function initialize() {
	document.getElementById("submit_credentials").onclick = login;
}

//direct credentials to authentication.php and then change to the supplied location
function login() {
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	var credentials = {"username":username, "password":password};
	$.post("http://ec2-52-90-44-3.compute-1.amazonaws.com/php/authentication.php",credentials,function(result) {
		window.location = result;
	});
}
window.onload = initialize;
