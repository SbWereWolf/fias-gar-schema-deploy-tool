CREATE TABLE IF NOT EXISTS ADDR_OBJ_PARAMS<?= $suffix ?>
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

/*CREATE UNIQUE INDEX ADDR_OBJ_PARAMS<?= $suffix ?>_REGION_ID_ux
ON ADDR_OBJ_PARAMS<?= $suffix ?> (REGION,ID);*/

ALTER TABLE ADDR_OBJ_PARAMS
ATTACH PARTITION ADDR_OBJ_PARAMS<?= $suffix ?> FOR
VALUES IN (<?= $suffix ?>);