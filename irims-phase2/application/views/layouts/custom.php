<!DOCTYPE html>
<!--@author Wildan Sawaludin-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<!--<![endif]-->
<html lang="en" class="no-js">
	<!-- BEGIN HEAD -->
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $template['title']; ?></title>
		<?php echo $template['metas']; ?>
		<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
		<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!-- BEGIN CSS STYLE -->
		<?php echo $template['css']; ?>
		<?php echo $template['css_global']; ?>
		<?php echo $template['css_admin']; ?>
		<!-- 1. AddChat css -->
        <link href="<?php echo base_url('assets/addchat/css/addchat.min.css') ?>" rel="stylesheet">
		<!-- Add to homescreen css -->
		<link href="<?php echo base_url('assets/add-to-homescreen/style/addtohomescreen.css') ?>" rel="stylesheet">
		<!-- BEGIN THEME STYLES -->
		<link href="<?php echo base_url() ?>assets/admin/layout/css/themes/blue.css" rel="stylesheet" media="screen" id="style_color"/>
		<!-- END THEME STYLES -->
		<!-- BEGIN ADD TO HOME SCREEN MOBILE PWA -->
		<link rel="manifest" href="<?php echo base_url() ?>manifest.json">

		<meta name="mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="application-name" content="Irims">
		<meta name="apple-mobile-web-app-title" content="Irims">
		<meta name="theme-color" content="#4276A4">
		<meta name="msapplication-navbutton-color" content="#4276A4">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<meta name="msapplication-starturl" content="<?php echo base_url() ?>index.php">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="icon" type="image/png" sizes="72x72" href="<?php echo base_url() ?>assets/img/pwa_icons/pwa/android-icon-72x72.png">
		<link rel="apple-touch-icon" type="image/png" sizes="72x72" href="<?php echo base_url() ?>assets/img/pwa_icons/pwa/android-icon-72x72.png">
		
		<!-- <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff"> -->

		<!-- END ADD TO HOME SCREEN MOBILE PWA -->
		<!-- BEGIN CSS STYLE -->
		<!-- BEGIN FAVICON AND TOUCH ICONS -->
		<link rel="shortcut icon" href="<?php echo base_url() ?>assets/admin/layout/img/favicon.ico">
		<!-- <link rel="shortcut icon" href="images/favicon.ico"> -->
		<!-- <link rel="apple-touch-icon" href="images/apple-touch-icon.png"> -->
		<!-- <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png"> -->
		<!-- <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png"> -->
		<!-- BEGIN FAVICON AND TOUCH ICONS -->
		<!-- BEGIN JAVASCRIPTS -->
		<?php echo $template['js_header']; ?>
		<?php echo $template['js_global']; ?>
		<?php echo $template['js_admin']; ?>
		<!-- END JAVASCRIPTS -->
	</head>
	<!-- END HEAD -->
	<!-- BEGIN BODY -->
	<?php
	// user is already logged in
	if ($this->auth->loggedin()) {
	?>
	<body class="page-md page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo ">
		<!-- 2. AddChat widget -->
        <div id="addchat_app" 
            data-baseurl="<?php echo base_url() ?>"
            data-csrfname="<?php echo $this->security->get_csrf_token_name() ?>"
            data-csrftoken="<?php echo $this->security->get_csrf_hash() ?>"
        ></div>
	<?php
	} else {
	?>
	<body class="page-md login">
	<?php
	}
	?>
		<!-- Define Variables -->
		<?php 
			$module 	= $this->uri->segment(1);
			$page   	= $this->uri->segment(2);
			$action 	= 'index';
			$actionTmp 	= $this->uri->segment(3);
			if($actionTmp != ''){
				$action =  $this->uri->segment(3);
			}
		?>
		<?php
		// user is already logged in
        if ($this->auth->loggedin()) {
		?>
			<!-- BEGIN LAYOUT NAVBAR -->
			<?php
				$detect = new Mobile_Detect();
				if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS() || $detect->isiOS()) {

				} else {
					$this->load->view('navbar-header', $template);
				}
			?>
			<!-- BEGIN CONTAINER -->
			<div class="page-container">
				<?php
					if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS() || $detect->isiOS()) {

					} else {
						$this->load->view('navbar-sidebar', $template);
					}
				?>
				<!-- BEGIN FULL CONTENT -->
				<div class="page-content-wrapper">
					<div class="page-content">
						<?php
							$this->load->view('navbar-theme-color', $template);
						?>
						<?php
							$menus = $this->config->item('main_nav');
						?>
						<!-- <div class="main-content"> -->
							<!-- <div class="container padded"> -->
								<?php
								if($module != 'welcome'){
								?>
									<!--div class="row">
										<div id="breadcrumbs">
											<div class="breadcrumb-button blue">
												<a href="<?php echo site_url()?>">
												<span class="breadcrumb-label"><i class="icon-home"></i> Home</span>
												<span class="breadcrumb-arrow"><span></span></span>
												</a>
											</div>
											<?php if(!empty($module)){?>
											<div class="breadcrumb-button <?php if(!empty($page)){ echo 'blue'; }?>">
												<a href="<?php echo site_url($module)?>">
													<span class="breadcrumb-label"><i class="<?php echo $menus[strtolower($module)]['icon'] ?>"></i> <?php echo $menus[strtolower($module)]['label'] ?></span>
												<span class="breadcrumb-arrow"><span></span></span>
												</a>
											</div>
											<?php } ?>
											<?php if(!empty($page)){?>
											<div class="breadcrumb-button <?php if(!empty($action)){ echo 'blue'; }?>">
												<a href="<?php echo site_url($module.'/'.$page)?>">
												<span class="breadcrumb-label"><i class="<?php echo $menus[$module]['sub_nav'][$module.'/'.$page]['icon']; ?>"></i> <?php echo $menus[$module]['sub_nav'][$module.'/'.$page]['label']; ?> </span>
												<span class="breadcrumb-arrow"><span></span></span>
												</a>
											</div>
											<?php } ?>
											<?php if(!empty($action)){?>
											<div class="breadcrumb-button">
												<span class="breadcrumb-label">
													<i class="icon-edit"></i> <?php echo $action?>
												</span>
												<span class="breadcrumb-arrow"><span></span></span>
											</div>
											<?php } ?>
										</div>
									</div-->
								<?php
								}
							?>
							<!-- </div> -->
							<!-- BEGIN CONTENT -->
							<?php echo $template['content']; ?>
							<!-- END CONTENT -->
						<!-- </div> -->
					</div>
				</div>
				<!-- END FULL CONTENT -->
				<?php
					$this->load->view('navbar-quick-sidebar', $template);
				?>
			</div>
			<!-- END CONTAINER -->
		<!-- BEGIN FOOTER -->
		<?php 
			if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS() || $detect->isiOS()) {
				$this->load->view('navbar-bottom');
			} else {
				$this->load->view('footer');
			} 
		?>
		<!-- BEGIN FOOTER -->
			<!-- END LAYOUT NAVBAR -->
		<?php
		// else user is not already logged in
        } else {
			if($module == 'welcome'){
				// Set redirect
				redirect(base_url());
				//show_error(lang('error_401'), 401, lang('error_401_title'));
			}
			//Display Login Form (no template)
			echo $template['content'];
		}
		?>
		<!-- Begin Placed at the end of the document so the pages load faster -->
		<?php echo $template['js_footer']; ?>
		<!-- End Placed at the end of the document so the pages load faster -->
		<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
		<script>
			jQuery(document).ready(function() {    
				Metronic.init(); // init metronic core componets
				Layout.init(); // init layout
				QuickSidebar.init(); // init quick sidebar
				Demo.init(); // init demo features
				Index.init();   
				Index.initDashboardDaterange();
				Index.initJQVMAP(); // init index page's custom scripts
				Index.initCalendar(); // init index page's custom scripts
				Index.initCharts(); // init index page's custom scripts
				Index.initChat();
				Index.initMiniCharts();
				Tasks.initDashboardWidget();
				//ChartsAmcharts.init(); // init demo amCharts
				//ChartsFlotcharts.init(); // init demo Flotharts
			   	//ChartsFlotcharts.initCharts(); // init demo Flotharts
			   	//ChartsFlotcharts.initPieCharts(); // init demo Flotharts
			   	//ChartsFlotcharts.initBarCharts(); // init demo Flotharts
				/* TableAdvanced.init(); */
				/* FormValidation.init(); */
			});
		</script>
		<!-- 3. AddChat JS -->
        <!-- Modern browsers -->
        <script  type="module" src="<?php echo base_url('assets/addchat/js/addchat.min.js') ?>"></script>
        <!-- Fallback support for Older browsers -->
        <script nomodule src="<?php echo base_url('assets/addchat/js/addchat-legacy.min.js') ?>"></script>
		<!-- Add to homescreen js -->
		<script src="<?php echo base_url('assets/add-to-homescreen/src/addtohomescreen.js') ?>"></script>
		<script>
			//if the website is not opened in app mode show (i.e. in a browser) the add to homescreen prompt
			if (
				(("standalone" in window.navigator) && !window.navigator.standalone) // ios
				||
				( !window.matchMedia('(display-mode: standalone)').matches ) //android
			) {
				addToHomescreen();
			}
		</script>

		<script>
			/*Begin PWA WEB Codeigniter*/
			UpUp.start({
				'cache-version': 'v2',
			  	'content-url': '<?php echo site_url($this->uri->segment(1))?>',
			  	'content': 'Cannot reach site. Please check your internet connection.',
			  	'service-worker-url': '<?php echo base_url('upup.sw.min.js')?>'
			});
			/*End PWA WEB Codeigniter*/
		</script>
		<!-- END JAVASCRIPTS -->
	</body>
	<!-- END BODY -->
</html>
