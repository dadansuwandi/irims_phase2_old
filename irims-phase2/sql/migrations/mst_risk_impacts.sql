ALTER TABLE `mst_risk_impacts` ADD COLUMN `impact_strategic` TEXT NULL AFTER `impact_operation_technique`;
ALTER TABLE `mst_risk_impacts` ADD COLUMN `impact_environment` TEXT NULL AFTER `impact_strategic`;
