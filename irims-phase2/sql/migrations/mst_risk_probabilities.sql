UPDATE `mst_risk_probabilities` SET `updated_by` = 1;
UPDATE `mst_risk_probabilities` SET `updated_date` = '2021-10-01 17:56:03';
ALTER TABLE `mst_risk_probabilities` MODIFY `frequency` TEXT NULL;
ALTER TABLE `mst_risk_probabilities` MODIFY `quantitative_criteria` TEXT NULL;
ALTER TABLE `mst_risk_probabilities` MODIFY `qualitative_criteria` TEXT NULL;
