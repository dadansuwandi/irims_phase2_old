<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */

/*constant for group id*/
define('GROUP_ADMINISTRATOR', 	 	1);
define('GROUP_RISK_ADMIN', 		 	2);
define('GROUP_RISK_HEADQUARTERS', 	3);
define('GROUP_RISK_LEADERS', 		8);
define('GROUP_RISK_OWNER', 			9);
define('GROUP_RISK_OFFICERS', 		10);
define('GROUP_RISK_BOD', 			12);

/*constant for status dokumen*/
define('STATUS_DRAFT',				1);
define('STATUS_APPROVE_ASSESSMENT',	2);
define('STATUS_CONFIRM',			3);
define('STATUS_ON_MONITORING',		4);
define('STATUS_MITIGATION',			5);
define('STATUS_MITIGATED',			6);

/*constant for risk level*/
define('RISIKO_SANGAT_TINGGI',	2);
define('RISIKO_TINGGI', 		3);
define('RISIKO_SEDANG', 		4);
define('RISIKO_RENDAH',			5);
define('RISIKO_SANGAT_RENDAH',	6);

/*constant for risk probability*/
define('RISK_PROBABILITY_VALUE_1', 1);
define('RISK_PROBABILITY_VALUE_2', 2);
define('RISK_PROBABILITY_VALUE_3', 3);
define('RISK_PROBABILITY_VALUE_4', 4);
define('RISK_PROBABILITY_VALUE_5', 5);

/*constant for risk probability*/
define('RISK_IMPACT_VALUE_A', 1);
define('RISK_IMPACT_VALUE_B', 2);
define('RISK_IMPACT_VALUE_C', 3);
define('RISK_IMPACT_VALUE_D', 4);
define('RISK_IMPACT_VALUE_E', 5);

/*constant for work paper type*/
define('TIPE_KERTAS_KERJA_PUMR', 0);
define('TIPE_KERTAS_KERJA_BUMN', 1);

/*constant for key risk indicator*/
define('LEADING', 1);
define('LAGGING', 2);
