<div class="bg_div"></div>
<nav class="navbar navbar_pe navbar-default navbar-default_pe navbar-fixed-top navbar-fixed-top_pe" role="navigation">
	<div class="navbar-header navbar-header_pe" >
		<button type="button" class="navbar-toggle navbar-toggle_pe" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<!--a class="navbar-brand" href=""><?php echo $site_name; ?></a-->
        <h1	class="editlogo">		
            <img	src="assets/dist/images/photographers_edit_new_logo1.png" onclick="document.location.href='pages/home'" 	 width="138px" height="69px"	alt="Photographer's	Edit"/>	
		</h1>		
        <h1	class="editlogo2">		
			<img	src="assets/dist/images/photographers_edit_new_logo2.png" onclick="document.location.href='pages/home'" width="130px" height="69px"	alt="Photographer's	Edit"/>	
		</h1>	
        <h1	class="editlogo3">		
			<img	src="assets/dist/images/photographers_edit_new_logo3.png" onclick="document.location.href='pages/home'" width="130px" height="69px"	alt="Photographer's	Edit"/>	
		</h1>
        <h1	class="editlogo4">	
			<img src="assets/dist/images/photographers_edit_new_logo2.png" onclick="document.location.href='pages/home'" width="130px" height="69px"	alt="Photographer's	Edit"/>	
		</h1>
        <div class="header_tag">
            Custom Post-Production<br/>
            for Wedding and Portrait <br/>
            Photographers
        </div>
	</div>

	<div class="navbar-collapse navbar-collapse_pe collapse ">

		<ul class="nav nav_pe navbar-nav navbar-nav_pe">
			<?php foreach ($menu as $parent => $parent_params): ?>

				<?php if (empty($parent_params['children'])): ?>

					<?php $active = ($current_uri==$parent_params['url'] || $ctrler==$parent); ?>
					<li <?php if ($active) echo 'class="active"'; ?>>
						<a href='<?php echo $parent_params['url']; ?>'>
							<?php echo $parent_params['name']; ?>
						</a>
					</li>

				<?php else: ?>

					<?php $parent_active = ($ctrler==$parent); ?>
					<li class='dropdown <?php if ($parent_active) echo 'active'; ?>'>
						<a data-toggle='dropdown' class='dropdown-toggle' href='#'>
							<?php echo $parent_params['name']; ?> <span class='caret'></span>
						</a>
						<ul role='menu' class='dropdown-menu'>
							<?php foreach ($parent_params['children'] as $name => $url): ?>
								<li><a href='<?php echo $url; ?>'><?php echo $name; ?></a></li>
							<?php endforeach; ?>
						</ul>
					</li>

				<?php endif; ?>

			<?php endforeach; ?>
		</ul>
		<ul class="nav nav_pe navbar-nav navbar-nav_pe   top_right_nav">
            <li class="links"><a href="#">Login</a></li>
            <li class="links"><a  href="#">Sign Up</a></li>
  </ul>
		<?php $this->load->view('_partials/language_switcher'); ?>
		
	</div>

</nav>
<div class="container_int_wrapper">
<div class="container content_holderwithoutbg">