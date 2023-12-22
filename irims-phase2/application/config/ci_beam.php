<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI_Beam
 * 
 * @package CI_Beam
 * @category Config
 * @author Wildan Sawaludin
 */
/**
 * CI_Beam Configuration.
 */

/**
 * Application Label Configuration 
 * 
 */
$config['page_title']		= 'IRIMS';
 
/**
 * Default number of rows to display on data tables 
 * 
 */
$config['rows_limit']		= 10000000000;

/*
 * Supported Languages
 * 
 */
$config['languages']		= array(
	'en' => array('name' => 'English', 'folder' => 'english'),
	'id' => array('name' => 'Bahasa Indonesia', 'folder' => 'indonesian')
);

/**
 * Main Navigation.
 * Primarily being used in views/navbar.php
 * 
 */

/* $config['main_nav']			= array(
	'welcome/bootstrap_demo/starter'	=> 'Starter',
	'welcome/bootstrap_demo/fluid'		=> 'Fluid',
	'welcome/bootstrap_demo/marketing'	=> 'Marketing',
	'auth/user'							=> 'User',
	'acl'								=> array(
		'acl/rule'		=> 'Rules',
		'acl/role'		=> 'Roles',
		'acl/resource'	=> 'Resources'
	)
); */

/**
 * Main Navigation.
 * Primarily being used in views/navbar.php
 * 
 */

$config['main_nav'] = array(
	'welcome' => array('icon' => 'icon-home', 'label' => 'Dashboard', 'sub_nav' => array(
      'welcome/index_corporate_worksheet' => array('icon' => 'icon-grid', 'label' => 'Top Risk'),
      'welcome/index_residual_worksheet' => array('icon' => 'icon-grid', 'label' => 'Residual Top Risk'),
			'welcome/index_corporate' => array('icon' => 'icon-grid', 'label' => 'Operational Risk'),
      'welcome/index_residual' => array('icon' => 'icon-grid', 'label' => 'Residual Ops Risk'),
      'welcome/index_kri' => array('icon' => 'icon-grid', 'label' => 'KRIs Dashboard'),
      'welcome/index_profile_kri' => array('icon' => 'icon-grid', 'label' => 'Risk Profile Dashboard'),
		)
    ),
    'risk' => array('icon' => 'icon-doc', 'label' => 'Risk Process', 'sub_nav' => array(
            'risk/risk_identification/index' => array('icon' => 'icon-list', 'label' => 'Risk Assessment'),
            'risk/risk_evaluation/index' => array('icon' => 'icon-list', 'label' => 'Risk Approval'),
            'risk/risk_assessment/monitored_list' => array('icon' => 'icon-list', 'label' => 'Risk Monitoring'),
            'risk/risk_evaluation/mitigated' => array('icon' => 'icon-list', 'label' => 'Risk Review'),
            'risk/risk_assessment/mitigated_list' => array('icon' => 'icon-list', 'label' => 'Risk Mitigation'),
            'risk/risk_backdate/index' => array('icon' => 'icon-list', 'label' => 'Additional'),
		)
    ),
    'report' => array('icon' => 'icon-docs', 'label' => 'Risk Report', 'sub_nav' => array(
            'report/risk_assessment_register_card/register_card' => array('icon' => 'icon-graph', 'label' => 'Risk Register Card'),
            'report/risk_assessment_report/index' => array('icon' => 'icon-graph', 'label' => 'Risk Progress'),
            'report/risk_assessment_report/head' => array('icon' => 'icon-graph', 'label' => 'Risk Progress'),
            'report/risk_assessment_report/owner' => array('icon' => 'icon-graph', 'label' => 'Risk Progress'),
            'report/risk_assessment_report/gm' => array('icon' => 'icon-graph', 'label' => 'Risk Progress'),
            'report/risk_assessment_report/officer' => array('icon' => 'icon-graph', 'label' => 'Risk Progress'),
            'report/risk_assessment_report/branch' => array('icon' => 'icon-graph', 'label' => 'Risk Progress Branch'),
            'report/risk_map/index' => array('icon' => 'icon-graph', 'label' => 'Risk Monitoring Map'),
            'report/risk_map/index_mitigated' => array('icon' => 'icon-graph', 'label' => 'Risk Mitigation Map'),
            'report/risk_map/index_identification' => array('icon' => 'icon-graph', 'label' => 'Risk Identification Map'),
            'report/risk_map/owner' => array('icon' => 'icon-graph', 'label' => 'Risk Monitoring Map'),
            'report/risk_map/index_mitigated_owner' => array('icon' => 'icon-graph', 'label' => 'Risk Mitigation Map'),
            'report/risk_map/gm' => array('icon' => 'icon-graph', 'label' => 'Risk Monitoring Map'),
            'report/risk_map/index_mitigated_gm' => array('icon' => 'icon-graph', 'label' => 'Risk Mitigation Map'),
            'report/risk_map/head' => array('icon' => 'icon-graph', 'label' => 'Risk Monitoring Map'),
            'report/risk_map/index_mitigated_head' => array('icon' => 'icon-graph', 'label' => 'Risk Mitigation Map'),
        )
    ),
    'risk_worksheet' => array('icon' => 'icon-doc', 'label' => 'Risk Process BUMN', 'sub_nav' => array(
          'risk_worksheet/risk_evaluation_worksheet/index' => array('icon' => 'icon-list', 'label' => 'RA Profile Corp'),
      )
    ),
    'risk_report' => array('icon' => 'icon-notebook', 'label' => 'Risk Report BOD/BOC', 'sub_nav' => array(
          'risk_report/work_paper_report/register_card' => array('icon' => 'icon-book-open', 'label' => 'Risk Register Card'),
          'risk_report/work_paper_report/index' => array('icon' => 'icon-book-open', 'label' => 'RA Worksheet'),
          'risk_report/work_paper_report/head' => array('icon' => 'icon-book-open', 'label' => 'RA Worksheet'),
          'risk_report/work_paper_report/owner' => array('icon' => 'icon-book-open', 'label' => 'RA Worksheet'),
          'risk_report/work_paper_report/gm' => array('icon' => 'icon-book-open', 'label' => 'RA Worksheet'),
          'risk_report/work_paper_report/officer' => array('icon' => 'icon-book-open', 'label' => 'RA Worksheet'),
          'risk_report/work_paper_report/index_monev' => array('icon' => 'icon-book-open', 'label' => 'Monev Worksheet'),
          'risk_report/work_paper_report/branch' => array('icon' => 'icon-book-open', 'label' => 'Risk Progress Branch'),
          'risk_report/riskchart_map/index' => array('icon' => 'icon-grid', 'label' => 'RA Risk Map'),
          'risk_report/riskchart_map/index_mitigated' => array('icon' => 'icon-grid', 'label' => 'Monev Risk Map'),
          'risk_report/riskchart_map/index_identification' => array('icon' => 'icon-grid', 'label' => 'Risk Identification Map'),
          'risk_report/riskchart_map/owner' => array('icon' => 'icon-grid', 'label' => 'RA Risk Map'),
          'risk_report/riskchart_map/index_mitigated_owner' => array('icon' => 'icon-grid', 'label' => 'Monev Risk Map'),
          'risk_report/riskchart_map/gm' => array('icon' => 'icon-grid', 'label' => 'RA Risk Map'),
          'risk_report/riskchart_map/index_mitigated_gm' => array('icon' => 'icon-grid', 'label' => 'Monev Risk Map'),
          'risk_report/riskchart_map/head' => array('icon' => 'icon-grid', 'label' => 'RA Risk Map'),
          'risk_report/riskchart_map/index_mitigated_head' => array('icon' => 'icon-grid', 'label' => 'Monev Risk Map'),
      )
    ),
    'kri' => array('icon' => 'icon-bar-chart', 'label' => 'Key Risk Indicator (KRI)', 'sub_nav' => array(
            'master/indicator/index' => array('icon' => 'icon-list', 'label' => 'Master Indicator'),
            'kri/key_risk_indicator_threshold/index' => array('icon' => 'icon-list', 'label' => 'Master Threshold'),
            'kri/key_risk_indicator/index' => array('icon' => 'icon-list', 'label' => 'Key Risk Indicator'),
            'kri/key_risk_indicator/index_list' => array('icon' => 'icon-list', 'label' => 'Key Risk Indicator'),
            'kri/key_risk_indicator/index_kri_report' => array('icon' => 'icon-list', 'label' => 'KRI Report'),
        )
    ),
    'elibrary' => array('icon' => 'icon-folder', 'label' => 'Risk Document', 'sub_nav' => array(
            'elibrary/elibrary/index' => array('icon' => 'icon-list', 'label' => 'E-Library'),
        )
    ),
	'master' => array('icon' => 'icon-settings', 'label' => 'Master', 'sub_nav' => array(
            'master/risk_category/index' => array('icon' => 'icon-list', 'label' => 'Risk Function'),
            'master/risk/index' => array('icon' => 'icon-list', 'label' => 'Risk Category'),
            'master/risk_item/index' => array('icon' => 'icon-list', 'label' => 'Risk Register'),
            'master/risk_level/index' => array('icon' => 'icon-list', 'label' => 'Risk Level'),
            'master/risk_probability/index' => array('icon' => 'icon-list', 'label' => 'Risk Probability'),
            'master/risk_impact/index' => array('icon' => 'icon-list', 'label' => 'Risk Impact'),
            'master/risk_impact_category/index' => array('icon' => 'icon-list', 'label' => 'Risk Impact Category'),
            'master/risk_impact_indicator/index' => array('icon' => 'icon-list', 'label' => 'Risk Impact Indicator'),
            'master/risk_value/index' => array('icon' => 'icon-list', 'label' => 'Risk Value'),
            'master/risk_directorate/index' => array('icon' => 'icon-list', 'label' => 'Risk Directorate'),
            'master/risk_pic/index' => array('icon' => 'icon-list', 'label' => 'Risk PIC'),
            'master/status_dokumen/index' => array('icon' => 'icon-list', 'label' => 'Status Dokumen'),
            'master/unit/index' => array('icon' => 'icon-list', 'label' => 'Branch'),
            'master/status/index' => array('icon' => 'icon-list', 'label' => 'Status'),
            'master/setting/index' => array('icon' => 'icon-list', 'label' => 'Setting'),
            'master/target_pencapaian/index' => array('icon' => 'icon-list', 'label' => 'Risk Target'),
            'master/risk_classification/index' => array('icon' => 'icon-list', 'label' => 'Risk Factor'),
            'master/risk_kpi/index' => array('icon' => 'icon-list', 'label' => 'Risk KPI'),
		)
    ),
    'auth' => array('icon' => 'icon-user', 'label' => 'User', 'sub_nav' => array(
			'auth/user/index' => array('icon' => 'icon-users', 'label' => 'List of Users'),
			'auth/role_map/index' => array('icon' => 'icon-book-open', 'label' => 'User Roles'),
		)
    ),
    'acl' => array('icon' => 'icon-wrench', 'label' => 'Setting', 'sub_nav' => array(
			'acl/rule/index' => array('icon' => 'icon-doc', 'label' => 'Rules'),
			'acl/role/index' => array('icon' => 'icon-docs', 'label' => 'Roles'),
			'acl/resource/index' => array('icon' => 'icon-share', 'label' => 'Resources'),
		)
    )
);
