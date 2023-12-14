--
-- Table structure for table `mst_exco_effectiveness_value_categories`
--

DROP TABLE IF EXISTS `mst_exco_effectiveness_value_categories`;
CREATE TABLE IF NOT EXISTS `mst_exco_effectiveness_value_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `group_value` int(10) DEFAULT NULL,
  `level` varchar(250) DEFAULT NULL,
  `exco_score` DECIMAL(15,2) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `unit_id` int(10) DEFAULT NULL,
  `created_by` int(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(20) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `mst_exco_effectiveness_value_categories`
--

INSERT INTO `mst_exco_effectiveness_value_categories` 
    (`id`, `code`, `name`, `group_value`, `level`, `exco_score`, `status`, `unit_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) 
VALUES
    (1, '001/EEVC/09/2021', 'Seluruh pengendalian risiko tepat, terdokumentasi resmi dan secara konsisten dilakukan dalam operasi.', 3, 'Sangat efektif', 0.10, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (2, '002/EEVC/09/2021', 'Seluruh pengendalian risiko tepat, tetapi dokumentasi dan operasi perlu sedikit perbaikan.', 4, 'Efektif', 0.25, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (3, '003/EEVC/09/2021', 'Seluruh pengendalian risiko tepat, tetapi dokumentasi dan operasi perlu banyak perbaikan.', 5, 'Sebagian efektif', 0.50, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (4, '004/EEVC/09/2021', 'Sebagian pengendalian risiko tepat, dokumentasi, dan operasi memerlukan banyak perbaikan.', 6, 'Kurang efektif', 0.75, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (5, '005/EEVC/09/2021', 'Pengendalian risiko tepat, tetapi tidak didokumentasikan dan tidak beroperasi.', 7, 'Tidak efektif', 1.00, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (6, '006/EEVC/09/2021', 'Pengendalian risiko tepat, tetapi tidak didokumentasikan dan tidak beroperasi.', 8, 'Tidak efektif', 1.00, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (7, '007/EEVC/09/2021', 'Pengendalian risiko tepat, tetapi tidak didokumentasikan dan tidak beroperasi.', 9, 'Tidak efektif', 1.00, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (8, '008/EEVC/09/2021', 'Pengendalian risiko tepat, tetapi tidak didokumentasikan dan tidak beroperasi.', 10, 'Tidak efektif', 1.00, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (9, '009/EEVC/09/2021', 'Pengendalian risiko tepat, tetapi tidak didokumentasikan dan tidak beroperasi.', 11, 'Tidak efektif', 1.00, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23'),
    (10, '010/EEVC/09/2021', 'Pengendalian risiko tidak tepat, dan tidak didokumentasikan atau beroperasi.', 12, 'Tidak efektif', 1.00, 1, 1, 1, '2021-09-25 3:19:23', 1, '2021-09-25 3:19:23');
