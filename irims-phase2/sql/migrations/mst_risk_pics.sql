ALTER TABLE `mst_risk_pics` ADD COLUMN `year` YEAR NULL AFTER `is_risk_viewer`;
ALTER TABLE `mst_risk_pics` ADD COLUMN `date` DATE NULL AFTER `year`;
ALTER TABLE `mst_risk_pics` ADD COLUMN `kpi` VARCHAR(250) NULL AFTER `date`;
ALTER TABLE `mst_risk_pics` ADD COLUMN `work_program` TEXT NULL AFTER `kpi`;
