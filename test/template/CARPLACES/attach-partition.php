ALTER TABLE CARPLACES
ATTACH PARTITION CARPLACES<?= $suffix ?> FOR
VALUES IN (<?= $suffix ?>)
