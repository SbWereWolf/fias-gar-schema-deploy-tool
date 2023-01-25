CREATE TABLE IF NOT EXISTS CARPLACES<?= $suffix ?>
(
REGION BIGINT,
ID BIGINT,
OBJECTID BIGINT,
OBJECTGUID TEXT,
CHANGEID BIGINT,
NUMBER TEXT,
OPERTYPEID BIGINT,
PREVID BIGINT,
NEXTID BIGINT,
UPDATEDATE DATE,
STARTDATE DATE,
ENDDATE DATE,
ISACTUAL BIGINT,
ISACTIVE BIGINT
);

/*CREATE UNIQUE INDEX CARPLACES<?= $suffix ?>_REGION_ID_ux
ON CARPLACES<?= $suffix ?> (REGION,ID);*/

ALTER TABLE CARPLACES
ATTACH PARTITION CARPLACES<?= $suffix ?> FOR
VALUES IN (<?= $suffix ?>);