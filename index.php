<?php include "header.php" ?>

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

<script>
	
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
		
		var name = "Hillary Clinton"; //$('#search-name').val();
		var topic = "abortion"; //$('#search-topic').val();
		
		// Validation including checking autocomplete
		
		
	});
});
  </script>

<?php include "footer.php" ?>