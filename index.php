<?php include "header.php" ?>

<div class="row full">
	<div class="fit-to-container">
		<div class="small-12 columns">
			<div class="hero-unit">
				<form id="home-search">
					<h1>I want to look up</h1>
					<input id="search-name" type="text" name="name" placeholder="ie. Hillary Clinton"/>
					<h1>and how he/she voted on in</h1>
					<input id="search-topic" type="text" name="topic" placeholder="ie. Abortion"/>
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
	$('#home-search input').keydown(function(event) {
        if (event.keyCode == 13) {
			var $this = $(this);
			
			if($('#search-name').val().length > 0 && $('#search-topic').val().length > 0) {
				$.ajax({
					dataType: "jsonp",
					data: "q=" + $('#search-name').val() + "&fields=id&format=jsonp",
					url: api_link + "person",
					cache: true
				}).done(function(data) {
					if (data.objects.length > 0)
						window.location.href = 'http://localhost/hackru/person.php?id=' + data.objects[0].id + '&topic=' + $('#search-topic').val();
					// Handle person doesn't exist
					else {
						invalid_input($('#search-name'));
					}
				});
			}
			else
				invalid_input($this);
			
			return false;
         }
    });
	
	invalid_input = function(e) {
		$(e).addClass('error');	
		$(e).shake(3, 16, 600);
	}
});

// Function
jQuery.fn.shake = function(intShakes /*Amount of shakes*/, intDistance /*Shake distance*/, intDuration /*Time duration*/) {
this.each(function() {
$(this).css({position:"relative"});
for (var x=1; x<=intShakes; x++) {
$(this).animate({left:(intDistance*-1)}, (((intDuration/intShakes)/4)))
.animate({left:intDistance}, ((intDuration/intShakes)/2))
.animate({left:0}, (((intDuration/intShakes)/4)));
}
});
return this;
};
  </script>

<?php include "footer.php" ?>