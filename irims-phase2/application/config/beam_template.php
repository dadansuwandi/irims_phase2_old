<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Beam-Template
 * 
 * @package Beam-Template
 * @category Config
 * @author Wildan Sawaludin
 */
/**
 * Beam-Template Configuration.
 */

/**
 * Path to Template Layout.
 * 
 * Default: 'application/views/layouts' 
 */
$config['beam_template']['layout_path'] = 'layouts';

/**
 * Default Template Layout
 * 
 * The default layout to use 
 * Default: 'default'
 */
$config['beam_template']['default_layout'] = 'custom';

/**
 * Path to Assets
 * 
 * Path to your assets files, default to 'assets'.
 */
$config['beam_template']['assets_path'] = 'assets';

/**
 * Default Site Title
 */
$config['beam_template']['base_title'] = 'IRIMS | PT Angkasa Pura II';

/**
 * Title Separator 
 */
$config['beam_template']['title_separator'] = ' | ';

/**
 * Default Site Metas
 */
$config['beam_template']['metas'] = array(
	'description'	=> 'Macmour House',
	'author'		=> 'Wildan Sawaludin',
	'viewport'		=> 'width=device-width, initial-scale=1'
);

/**
 * Default CSS 
 */
$config['beam_template']['css'] = array(
	//'bootstrap',
	//'default-style' => array(
		//'style' => '
		//body {
			//padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		//}'
	//),
	//'bootstrap-theme',
	//'simple-lists'
);

/**
 * Default Javascript
 */
$config['beam_template']['js_header'] = array(
	//'jquery',
);
$config['beam_template']['js_footer'] = array(
	//'bootstrap',
	/*begin define for PWA with UpUp JS*/
	'upup/dist/upup.min',
	/*end define for PWA with UpUp JS*/
);

/**
 * Default Image 
 */
$config['beam_template']['img'] = array(
	/* not define in library/beam/Template.php */
);

/**
 * Default Font 
 */
$config['beam_template']['fonts'] = array(
	/* not define in library/beam/Template.php */
);

/**
 * Default Assets Global CSS
 */
$config['beam_template']['css_global'] = array(
	/* BEGIN GLOBAL MANDATORY STYLES */
	'css/fonts.googleapis',
	'plugins/font-awesome/css/font-awesome.min',
	'plugins/simple-line-icons/simple-line-icons.min',
	'plugins/bootstrap/css/bootstrap.min',
	'plugins/uniform/css/uniform.default',
	'plugins/bootstrap-switch/css/bootstrap-switch.min',
	/* END GLOBAL MANDATORY STYLES */
	/* BEGIN PAGE LEVEL PLUGIN STYLES */
	'plugins/bootstrap-daterangepicker/daterangepicker-bs3',
	'plugins/fullcalendar/fullcalendar.min',
	'plugins/jqvmap/jqvmap/jqvmap',
	'plugins/select2/select2',
	'plugins/datatables/extensions/Scroller/css/dataTables.scroller.min',
	'plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min',
	'plugins/datatables/plugins/bootstrap/dataTables.bootstrap',
	'plugins/bootstrap-wysihtml5/bootstrap-wysihtml5',
	'plugins/bootstrap-wysihtml5/wysiwyg-color',
	'plugins/bootstrap-markdown/css/bootstrap-markdown.min',
	'plugins/bootstrap-datepicker/css/bootstrap-datepicker3',
	'plugins/bootstrap-fileinput/bootstrap-fileinput',
	'plugins/clockface/css/clockface',
	'plugins/bootstrap-timepicker/css/bootstrap-timepicker.min',
	'plugins/bootstrap-colorpicker/css/colorpicker',
	'plugins/bootstrap-daterangepicker/daterangepicker-bs3',
	'plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min',
	/* END PAGE LEVEL PLUGIN STYLES */
	/* BEGIN THEME STYLES */
	'css/components-md',
	'css/plugins-md',
	/* END THEME STYLES */
);

/**
 * Default Assets Global Javascript
 */
$config['beam_template']['js_global'] = array(
	/* BEGIN CORE PLUGINS */
	'plugins/jquery.min',
	'plugins/jquery-migrate.min',
	'plugins/jquery-ui/jquery-ui.min',
	'plugins/bootstrap/js/bootstrap.min',
	'plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min',
	'plugins/jquery-slimscroll/jquery.slimscroll.min',
	'plugins/jquery.blockui.min',
	'plugins/jquery.cokie.min',
	'plugins/uniform/jquery.uniform.min',
	'/plugins/bootstrap-switch/js/bootstrap-switch.min',
	/* END CORE PLUGINS */
	/* BEGIN PAGE LEVEL PLUGINS */
	'plugins/jquery.pulsate.min',
	'plugins/bootstrap-daterangepicker/moment.min',
	'plugins/bootstrap-daterangepicker/daterangepicker',
	'plugins/fullcalendar/fullcalendar.min',
	'plugins/jquery-easypiechart/jquery.easypiechart.min',
	'plugins/jquery.sparkline.min',
	'plugins/select2/select2.min',
	'plugins/datatables/media/js/jquery.dataTables.min',
	'plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min',
	'plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min',
	'plugins/datatables/extensions/Scroller/js/dataTables.scroller.min',
	'plugins/datatables/plugins/bootstrap/dataTables.bootstrap',
	'plugins/jquery-validation/js/jquery.validate.min',
	'plugins/jquery-validation/js/additional-methods.min',
	'plugins/bootstrap-datepicker/js/bootstrap-datepicker.min',
	'plugins/bootstrap-wysihtml5/wysihtml5-0.3.0',
	'plugins/bootstrap-wysihtml5/bootstrap-wysihtml5',
	'plugins/ckeditor/ckeditor',
	'plugins/bootstrap-markdown/js/bootstrap-markdown',
	'plugins/bootstrap-markdown/lib/markdown',
	'plugins/bootstrap-fileinput/bootstrap-fileinput',
	'plugins/bootstrap-timepicker/js/bootstrap-timepicker.min',
	'plugins/clockface/js/clockface',
	'plugins/bootstrap-colorpicker/js/bootstrap-colorpicker',
	'plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min',
	'plugins/auto-numeric/autoNumeric.min',
	'plugins/rupiah-format/rupiah',
	/* END PAGE LEVEL PLUGINS*/
	/* BEGIN PAGE LEVEL SCRIPTS */
	'scripts/metronic',
	/* END PAGE LEVEL SCRIPTS */
);

/**
 * Default Assets Admin CSS
 */
$config['beam_template']['css_admin'] = array(
	/* BEGIN PAGE STYLES */
	'pages/css/tasks',
	'pages/css/profile',
	'pages/css/tasks',
	/* END PAGE STYLES */
	/* BEGIN THEME STYLES */
	'layout/css/layout',
	//'layout/css/themes/darkblue', (define in views/layouts/custom)
	'layout/css/custom',
	/* END THEME STYLES */
);

/**
 * Default Assets Admin Javascript
 */
$config['beam_template']['js_admin'] = array(
	/* BEGIN PAGE LEVEL SCRIPTS */
	'layout/scripts/layout',
	'layout/scripts/quick-sidebar',
	'layout/scripts/demo',
	'pages/scripts/index',
	'pages/scripts/tasks',
	'pages/scripts/table-advanced',
	'pages/scripts/form-validation',
	'pages/scripts/components-pickers',
	/* END PAGE LEVEL SCRIPTS */
);
