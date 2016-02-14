	<!-- Google Tag Manager -->
	<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TH3F2C"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-TH3F2C');</script>
	<!-- End Google Tag Manager -->
	
	<header>
		<div class="container-fluid">
			<div class="row title">
				<div class="text-center col-xs-4 col-sm-3 col-md-2"><img src="images/CCRN Logo.jpg" align="left" class="img-responsive" alt="The CCRN Logo. The Colorado state flag, with the letters CCRN spelled out on it."></div>
				<div class="col-xs-8 col-sm-9 col-md-10" id="site-title-div"><h1 id="site-title-block"><a href="index.php" class="site-title">Colorado Community Radio Network</a></h1></div>
			</div>
			<br>
			<div class="row">
				<nav class = "navbar" role = "navigation">
					<div class="container-fluid">
						<div class="navbar-header visible-xs-block navbar-default">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
								<span class = "sr-only">Toggle navigation</span>
								<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
							</button>
							<a class = "navbar-brand" href = ""><?php echo $pagename ?></a>
						</div>
						<div class="collapse navbar-collapse" id="myNavbar">
							<ul class="nav nav-tabs nav-justified">
								<li role="presentation"<?php if ($pagename == "Home") { echo ' class="active"'; } ?>><a href="index.php">Home</a></li>
								<li role="presentation"<?php if ($pagename == "About") { echo ' class="active"'; } ?>><a href="about.php">About</a></li>
								<li role="presentation"<?php if ($pagename == "Events") { echo ' class="active"'; } ?>><a href="events.php">Events</a></li>
								<li role="presentation"<?php if ($pagename == "Schedule") { echo ' class="active"'; } ?>><a href="schedule.php">Schedule</a></li>
								<li role="presentation"<?php if ($pagename == "Archives") { echo ' class="active"'; } ?>><a href="archives.php">Archives</a></li>
								<li role="presentation"><a href="http://coloradocommunityradio.com/docu_wiki/doku.php">Wiki</a></li>
								<li role="presentation"<?php if ($pagename == "Contact") { echo ' class="active"'; } ?>><a href="contact.php">Contact</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</header>