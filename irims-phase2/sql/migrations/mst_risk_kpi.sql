CREATE TABLE IF NOT EXISTS `mst_risk_kpi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `status` int(2) NOT NULL DEFAULT '1',
  `unit_id` int(10) DEFAULT NULL,
  `created_by` int(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;