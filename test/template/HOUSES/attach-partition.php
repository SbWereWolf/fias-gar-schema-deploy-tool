ALTER TABLE HOUSES
ATTACH PARTITION HOUSES<?= $suffix ?> FOR VALUES IN (<?= $suffix ?>)
