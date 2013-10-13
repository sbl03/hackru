<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Politician Bill Lookup Tool</title>

  
  <link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/main.css">

  <script src="js/vendor/custom.modernizr.js"></script>

</head>
<body>

<div class="row full">
	<div class="fit-to-container">
		<div class="small-12 columns">
			<div class="hero-unit">
				<form id="home-search">
					<h1>I want to look up</h1>
					<input id="search-name" type="text" name="name" />
					<h1>and how he/she voted on in</h1>
					<input id="search-topic" type="text" name="topic" />
					<button type="submit">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  
  <script src="js/foundation.min.js"></script>
  
  <script>
    $(document).foundation();
	
$(document).ready(function() {
	var api_link = 'http://www.govtrack.us/api/v2/';
	
	/*$("#search-name").autocomplete({
		source: function(request, response) {
			$.ajax({
				url: "some-url",
				dataType: "jsonp",
				data: "",
				success: function(data) {
					
				}
			});
		}
	});*/
	
	$('#home-search').submit(function(e) {
		e.preventDefault();
		
		var name = $('#search-name').val();
		var topic = $('#search-topic').val();
		
		// Validation including checking autocomplete
		/*$.getJSON(api_link + "person?q=Hillary%20Clinton&fields=id&format=json", function(data) {
			console.log(data);
		});*/
		$.ajax({
			//type: "POST",
			dataType: "json",
			url: api_link + "person?q=" + name + "&fields=id",
			//data: $(e).serialize(),
			success: function(data) {
				console.log(data);
			}
		});
	});
});
  </script>
</body>
</html>
