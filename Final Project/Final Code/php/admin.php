<!-- FILE: admin.php
     DATE: 11/28/2017
	 PROJECT TEAM: Alexander DeForge, Douglas Evert, Pierre Lucceus, Galen Yanofsky
	 AUTHOR (Revision Table): 
	 Alexander DeForge::entire document (11/28) 
	 Alexander DeForge :: implemented php to redirect if not arrived at from login page (index.html) (12/14)
	 Alexander DeForge :: added onbeforeunload and logout button (12/15)
     PURPOSE: HTML markup for Admin View in HR webapp
-->
<!DOCTYPE html>
<head>
<?php
	// continue and close the admin session, if applicable, otherwise redirect to the error page
	session_start();
	if ($_SESSION["admin"] == null) {
		session_destroy();
		header("Location: http://ec2-52-90-44-3.compute-1.amazonaws.com/site/oops.html");
		exit();
	}
	session_destroy();
?>
<meta charset="UTF-8"> 
<title>Administrator View</title>
</head>
<body>
	<main role="main">
	  <div class="container-fluid">
		<div class="row">
			<div class="col-md-12, mx-auto">
				<p class="text-center"><a class="btn btn-secondary" href="http://ec2-52-90-44-3.compute-1.amazonaws.com" role="button">Log Out</a></p>
			</div>
		</div>
	    <div class="row">
	      <div class="col-md-4, mx-auto">
	        <p class="text-center"><a id="search_button" class="btn btn-secondary" href="#" role="button">SEARCH</a></p>
			<form>
				<div id="search" class="form-group">
					<div class="section">
						<label>Name(s):</label>
						<ul class="list-group names">
							<li class="list-group-item"><input type="text" class="form-control">
								<a class="btn btn-secondary remove" href="#" role="button">-</a>
								<a class="btn btn-secondary add" href="#" role="button">+</a>
							</li>
						</ul>
					</div>
					<div class="section">
						<label>Phone(s):</label>					
						<ul class="list-group phones">
							<li class="list-group-item"><input type="text" class="form-control">
								<a class="btn btn-secondary remove" href="#" role="button">-</a>
								<a class="btn btn-secondary add" href="#" role="button">+</a>
							</li>
						</ul>
					</div>
					<div class="section">
						<label>Address(s):</label>					
						<ul class="list-group addresses">
							<li class="list-group-item"><input type="text" class="form-control">
								<a class="btn btn-secondary remove" href="#" role="button">-</a>
								<a class="btn btn-secondary add" href="#" role="button">+</a>
							</li>
						</ul>
					</div>
					<div class="section salaries">
						<label>Salary Range:</label>
						<input type="text" class="form-control" value="">
						<p class="text-center"> TO </p>
						<input type="text" class="form-control" value="">
					</div>
					<div class="section ptobalances">
						<label>PTO Balance Range:</label>
						<input type="text" class="form-control" value="">
						<p class="text-center"> TO </p>
						<input type="text" class="form-control" value="">
					</div>
					<div class="section">
						<label>Demographic(s):</label>						
						<ul class="list-group demographics">
							<li class="list-group-item"><input type="text" class="form-control">
								<a class="btn btn-secondary remove" href="#" role="button">-</a>
								<a class="btn btn-secondary add" href="#" role="button">+</a>
							</li>
						</ul>
					</div>
					<div class="section">
						<label>Note(s):</label>						
						<ul class="list-group notes">
							<li class="list-group-item"><input type="text" class="form-control">
								<a class="btn btn-secondary remove" href="#" role="button">-</a>
								<a class="btn btn-secondary add" href="#" role="button">+</a>
							</li>
						</ul>
					</div>
				</div>
			</form>
	      </div>
	      <div id="read" class="col-md-4, mx-auto">
			<p class="text-center"><a id="remove_button" class="btn btn-secondary" href="#" role="button">REMOVE</a></p>
			<div id="results" class="list-group section">
				<a class="list-group-item list-group-item-action">Employee Search Results</a>
			</div>
	      </div>
	      <div class="col-md-4, mx-auto">
	        <p class="text-center"><a id="update_button" class="btn btn-secondary" href="#" role="button">UPDATE</a></p>
	        	<form>
				<div id="write" class="form-group">
					<div class="section">
						<label>Name(s):</label>
						<ul class="list-group names">
							<li class="list-group-item"><input type="text" class="form-control">
								<a class="btn btn-secondary remove" href="#" role="button">-</a>
								<a class="btn btn-secondary add" href="#" role="button">+</a>
							</li>
						</ul>
					</div>
					<div class="section">
						<label>Phone(s):</label>					
						<ul class="list-group phones">
							<li class="list-group-item"><input type="text" class="form-control">
								<a class="btn btn-secondary remove" href="#" role="button">-</a>
								<a class="btn btn-secondary add" href="#" role="button">+</a>
							</li>
						</ul>
					</div>
					<div class="section">
						<label>Address(s):</label>					
						<ul class="list-group addresses">
							<li class="list-group-item"><input type="text" class="form-control">
								<a class="btn btn-secondary remove" href="#" role="button">-</a>
								<a class="btn btn-secondary add" href="#" role="button">+</a>
							</li>
						</ul>
					</div>
					<div class="section">
						<label>Salary:</label>
						<ul class="list-group salaries">
							<li class="list-group-item"><input type="text" class="form-control" value="">
							</li>
						</ul>
					</div>
					<div class="section">
						<label>PTO Balance:</label>
						<ul class="list-group ptobalances">
							<li class="list-group-item"><input type="text" class="form-control" value="">
							</li>
						</ul>
						
					</div>
					<div class="section">
						<label>Demographic(s):</label>						
						<ul class="list-group demographics">
							<li class="list-group-item"><input type="text" class="form-control">
								<a class="btn btn-secondary remove" href="#" role="button">-</a>
								<a class="btn btn-secondary add" href="#" role="button">+</a>
							</li>
						</ul>
					</div>
					<div class="section">
						<label>Note(s):</label>						
						<ul class="list-group notes">
							<li class="list-group-item"><input type="text" class="form-control">
								<a class="btn btn-secondary remove" href="#" role="button">-</a>
								<a class="btn btn-secondary add" href="#" role="button">+</a>
							</li>
						</ul>
					</div>
				</div>
			</form>
	        <p class="text-center"><a id="add_button" class="btn btn-secondary" href="#" role="button">ADD</a></p>
	      </div>
	    </div>
	    <hr>
	  </div> 
	</main>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="http://ec2-52-90-44-3.compute-1.amazonaws.com/css/admin.css">
	<script src="http://ec2-52-90-44-3.compute-1.amazonaws.com/js/admin.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

	<script>
		window.onbeforeunload = function() { return "Leave this page?"; }
	</script>
</body>
</html>
