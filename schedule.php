<?php 
	$pagename = "Schedule";
	// import html head section
	require 'head.php'; 
	// start html body section
	echo "<body>";
	// inport header
	require 'header.php'; 
?>

	<div class="container-fluid">	
		<div class="row">
			<iframe src="https://calendar.google.com/calendar/embed?mode=WEEK&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=cocommunityradio%40gmail.com&amp;color=%238C500B&amp;src=kglrfm%40gmail.com&amp;color=%232F6309&amp;src=wayhighradio%40gmail.com&amp;color=%23182C57&amp;ctz=America%2FDenver" style="border-width:0" width="90%" height="600" frameborder="0" scrolling="no" class="hidden-xs"></iframe>
			<iframe src="https://calendar.google.com/calendar/embed?title=Colorado%20Community%20Radio%20Network&amp;showPrint=0&amp;showTabs=0&amp;mode=AGENDA&amp;height=500&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=cocommunityradio%40gmail.com&amp;color=%238C500B&amp;src=kglrfm%40gmail.com&amp;color=%232F6309&amp;src=wayhighradio%40gmail.com&amp;color=%23182C57&amp;ctz=America%2FDenver" style="border-width:0" width="95%" height="500" frameborder="0" scrolling="no"  class="visible-xs-block"></iframe>
			<p>Way High Radio shows are in Blue. Green Light Radio shows are in green.</p>
		</div>
	</div>
	
<?php
	require 'footer.php'; 
?>