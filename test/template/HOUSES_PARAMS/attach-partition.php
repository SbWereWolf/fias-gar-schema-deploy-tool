ALTER TABLE HOUSES_PARAMS
ATTACH PARTITION HOUSES_PARAMS<?= $suffix ?> FOR
VALUES IN (<?= $suffix ?>)