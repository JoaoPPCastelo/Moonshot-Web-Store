<div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
	<!-- Overlay -->
	<div class="overlay"></div>

	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
		<li data-target="#bs-carousel" data-slide-to="1"></li>
		<li data-target="#bs-carousel" data-slide-to="2"></li>
	</ol>

	<!--Wrapper for slides -->
	<div class="carousel-inner">
		<div class="item slides active">
			<div class="slide-1">
				<img src=<?php echo $imageSource[0]->source ?> alt="Photo">
			</div>
		</div>
		<div class="item slides">
			<div class="slide-2">
				<img src=<?php echo $imageSource[1]->source ?> alt="Photo">
			</div>
		</div>
		<div class="item slides">
			<div class="slide-3">
				<img src=<?php echo $imageSource[2]->source ?> alt="Photo">
			</div>
		</div>
	</div>

	<div class="site-name">
		<h1 class="site-name-content">Moonshot</h1>
	</div> 
</div>