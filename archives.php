<?php 
	$pagename = "Archives";
	// import html head section
	require 'head.php'; 
	// start html body section
	echo "<body>";
	// inport header
	require 'header.php'; 
?>

	<div class="container-fluid">	
		<div class="row">
			<div class="col-xs-12"><h1>CCRN Media Archives</h1></div>
		</div>
		<div class="row">
			<div class="col-xs-3">
				<h2>Archive.org Links</h2>
				<a href="https://archive.org/details/@kglrfm">Green Light Radio</a><br>
				<a href="https://archive.org/details/@skybfly">Way High Radio</a><br>
				<a href="https://archive.org/search.php?query=kbfr%20OR%20boulder%20free%20radio">Boulder Free Radio</a><br>
				<a href="https://archive.org/details/RushadEggleston_201601">Rushad Eggleston at Blue Owl Books</a><br>
			</div>
			<div class="col-xs-9">
				<h2>Photos and Videos</h2>
				<div class="row">
					<div class="col-xs-6">
						<h4>Banshee Tree Playing Live on CCRN at Frozen Dead Guy Days (<a href= "#">listen to the recording here</a>)</h4>
						<img src="images/Banshee Tree.jpg"  class="img-responsive" alt="Local swing band Banshee Tree, playing live on air in CCRN's studio, during Frozen Dead Guy Days 2015">
					</div>
					<div class="col-xs-6">
						<h4>Our pop up radio studio in a tuff shed at Frozen Dead Guy Days 2015 (<a href= "#">check out the archives here</a>)</h4>
						<img src="images/FDGD2015.jpg"  class="img-responsive" alt="Our pop up radio studio in a tuff shed at Frozen Dead Guy Days 2015">
						<h4>The Blue Ball Tent at Frozen Dead Guy Days 2015</h4>
						<img src="images/FDGD2015Tent.jpg"  class="img-responsive" alt="Our pop up radio studio in a tuff shed at Frozen Dead Guy Days 2015">
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-12">
						<h3>Way High Radio Promo Video</h3>
						<iframe width="853" height="480" src="https://www.youtube-nocookie.com/embed/gYpYreUpXYk" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>	
			</div>
		</div>
    </div>

<?php
	require 'footer.php'; 
?>