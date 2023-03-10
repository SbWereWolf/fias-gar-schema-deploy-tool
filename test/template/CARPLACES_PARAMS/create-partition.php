CREATE TABLE IF NOT EXISTS CARPLACES_PARAMS<?= $suffix ?>
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

/*CREATE UNIQUE INDEX CARPLACES_PARAMS<?= $suffix ?>_REGION_ID_ux
ON CARPLACES_PARAMS<?= $suffix ?> (REGION,ID);*/

ALTER TABLE CARPLACES_PARAMS
ATTACH PARTITION CARPLACES_PARAMS<?= $suffix ?> FOR
VALUES IN (<?= $suffix ?>);