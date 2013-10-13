<?php include "header.php" ?>

<?php
	$person_id = $_REQUEST['id'];
	$topic = $_REQUEST['topic'];
?>

<div class="row full">
	<div class="fit-to-container">
		<div class="small-12 columns">
			<div id="profile-img">
				<img src="http://www.govtrack.us/data/photos/<?php echo $person_id ?>-200px.jpeg" />
			</div>
			<div id="profile-desc">
				<h1></h1>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="small-12 columns">
		<hr />
		<div id="topic-list">
			<?php if(!empty($topic)) { ?>
			<h2>Topic: <?php echo $topic ?></h2>		
			<?php }	?>
			<ul id="bills-list">
			
			</ul>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	var api_link = 'http://www.govtrack.us/api/v2/';
	var person_id = <?php echo $person_id; ?>;
	var topic = '<?php echo $topic; ?>';
	
	$.ajax({
		dataType: "jsonp",
		data: "format=jsonp",
		url: api_link + "person/<?php echo $person_id ?>",
		cache: true
	}).done(function(data) {
		$('#profile-desc h1').text(data.firstname + ' ' + data.middlename + ' ' + data.lastname);
	});
	
	// Get the ID of the person
	/*$.ajax({
		dataType: "jsonp",
		data: "q=" + name + "&fields=id&format=jsonp",
		url: api_link + "person",
		cache: true
	}).done(function(data) {*/
		//var person_id = data.objects[0].id;
		var congress_num = Array();

		// Get all of the congress numbers for the member
		$.ajax({
			dataType: "jsonp",
			data: "format=jsonp",
			url: api_link + "person/" + person_id,
			cache: true
		}).done(function(data2) {
			$(data2.roles).each(function(i, e) {
				$(e.congress_numbers).each(function(i2, e2) {
					congress_num.push(e2);
				});
			});
			
			// Get all of the bills from those congress numbers
			$(congress_num).each(function(i3, e3) {
				$.ajax({
					dataType: "jsonp",
					data: "congress=" + e3 + "&q=" + topic + "&limit=600&format=jsonp",
					url: api_link + "bill",
					cache: true
				}).done(function(data3) {
					$(data3.objects).each(function(i4, e4) {
						$(e4.id).each(function(i5, e5) {
							// Get the bills that the person voted on
							$(e5).each(function(i6, e6) {
								$.ajax({
									dataType: "jsonp",
									data: "related_bill=" + e6 + "&limit=600&format=jsonp",
									url: api_link + "vote",
									cache: true
								}).done(function(data4) {
									if(data4.objects.length > 0) {
										var vote_id = data4.objects[0].id; // BAD
										
										$.ajax({
											dataType: "jsonp",
											data: "vote=" + vote_id + "&person=" + person_id + "&format=jsonp",
											url: api_link + "vote_voter",
											cache: true
										}).done(function(data5) {
											if(data5.objects.length > 0) {
												var this_bill = data4.objects[0].related_bill;
												$('#bills-list').append('<li><div class="bill_upper"><a href="' + this_bill.link + '">' + this_bill.title_without_number + '</a><span class="bill_vote">' + data5.objects[0].option.key + '</span></div><div class="bill_lower"><span class="bill_date">' + this_bill.current_status_date + '</span></li>');
											}
										});
									}
								});
							});
						});
					});
				});
			});
		});
	//});
});
</script>

<?php include "footer.php" ?>