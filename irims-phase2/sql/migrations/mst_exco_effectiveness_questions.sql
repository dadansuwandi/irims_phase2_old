--
-- Table structure for table `mst_exco_effectiveness_questions`
--

DROP TABLE IF EXISTS `mst_exco_effectiveness_questions`;
CREATE TABLE IF NOT EXISTS `mst_exco_effectiveness_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `unit_id` int(10) DEFAULT NULL,
  `created_by` int(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(20) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mst_exco_effectiveness_questions`
--

INSERT INTO `mst_exco_effectiveness_questions` 
    (`id`, `code`, `name`, `status`, `unit_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) 
VALUES
    (1, '001/EEQ/09/2021', 'Aspek 1: Apakah kontrol bersifat preventif dan protektif?', 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (2, '002/EEQ/09/2021', 'Aspek 2: Apakah kontrol secara resmi telah didokumentasikan dan dikomunikasikan?', 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (3, '003/EEQ/09/2021', 'Aspek 3: Apakah kontrol telah diterapkan dalam operasi secara konsisten?', 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23');
