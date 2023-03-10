CREATE TABLE IF NOT EXISTS ROOMS_PARAMS<?= $suffix ?>
(
REGION BIGINT,
ID BIGINT,
OBJECTID BIGINT,
CHANGEID BIGINT,
CHANGEIDEND BIGINT,
TYPEID BIGINT,
VALUE TEXT,
UPDATEDATE DATE,
STARTDATE DATE,
ENDDATE DATE
);

/*CREATE UNIQUE INDEX ROOMS_PARAMS<?= $suffix ?>_REGION_ID_ux
ON ROOMS_PARAMS<?= $suffix ?> (REGION,ID);*/

ALTER TABLE ROOMS_PARAMS
ATTACH PARTITION ROOMS_PARAMS<?= $suffix ?> FOR
VALUES IN (<?= $suffix ?>);