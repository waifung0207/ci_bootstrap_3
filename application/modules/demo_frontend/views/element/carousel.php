<div id="carousel-home" class="carousel slide" data-ride="carousel" style="width:1000px">

	<!-- Indicators -->
	<ol class="carousel-indicators">
		<?php for ($i=0; $i<count($photos); $i++): ?>
		<li data-target="#carousel-home" data-slide-to="<?php echo $i; ?>" class="<?php if ($i==0) echo "active"; ?>"></li>
		<?php endfor; ?>
	</ol>
	
	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
		<?php for ($i=0; $i<count($photos); $i++): ?>
		<div class="item <?php if ($i==0) echo "active"; ?>">
			<img src="<?php echo $photos[$i]->image_url; ?>" alt="Photo <?php echo $i+1; ?>" />
			<div class="carousel-caption">
				<p>Image Source: <a href="https://unsplash.com/">https://unsplash.com/</a></p>
			</div>
		</div>
		<?php endfor; ?>
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#carousel-home" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#carousel-home" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>