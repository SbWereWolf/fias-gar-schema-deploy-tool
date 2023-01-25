CREATE TABLE IF NOT EXISTS HOUSES<?= $suffix ?>
(
REGION BIGINT,
ID BIGINT,
OBJECTID BIGINT,
OBJECTGUID TEXT,
CHANGEID BIGINT,
HOUSENUM TEXT,
ADDNUM1 TEXT,
ADDNUM2 TEXT,
HOUSETYPE BIGINT,
ADDTYPE1 BIGINT,
ADDTYPE2 BIGINT,
OPERTYPEID BIGINT,
PREVID BIGINT,
NEXTID BIGINT,
UPDATEDATE DATE,
STARTDATE DATE,
ENDDATE DATE,
ISACTUAL BIGINT,
ISACTIVE BIGINT
);

/*CREATE UNIQUE INDEX HOUSES<?= $suffix ?>_REGION_ID_ux
ON HOUSES<?= $suffix ?> (REGION,ID);*/

ALTER TABLE HOUSES
ATTACH PARTITION HOUSES<?= $suffix ?> FOR VALUES IN (<?= $suffix ?>);