--
-- Table structure for table `mst_exco_effectiveness_answers`
--

DROP TABLE IF EXISTS `mst_exco_effectiveness_answers`;
CREATE TABLE IF NOT EXISTS `mst_exco_effectiveness_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `aspect_value` int(10) DEFAULT NULL,
  `exco_effectiveness_question_id` int(10) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `unit_id` int(10) DEFAULT NULL,
  `created_by` int(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(20) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `mst_exco_effectiveness_answers`
--

INSERT INTO `mst_exco_effectiveness_answers` 
    (`id`, `code`, `name`, `aspect_value`, `exco_effectiveness_question_id`, `status`, `unit_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) 
VALUES
    (1, '001/EEA/09/2021', 'Ya', 1, 1, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (2, '002/EEA/09/2021', 'Sebagian', 3, 1, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (3, '003/EEA/09/2021', 'Tidak', 6, 1, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (4, '004/EEA/09/2021', 'Ya', 1, 2, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (5, '005/EEA/09/2021', 'Sebagian', 2, 2, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (6, '006/EEA/09/2021', 'Tidak', 3, 2, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (7, '007/EEA/09/2021', 'Ya', 1, 3, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (8, '008/EEA/09/2021', 'Sebagian', 2, 3, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (9, '009/EEA/09/2021', 'Tidak', 3, 3, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23');
