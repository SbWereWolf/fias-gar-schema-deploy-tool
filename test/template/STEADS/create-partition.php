CREATE TABLE IF NOT EXISTS STEADS<?= $suffix ?>
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

/*CREATE UNIQUE INDEX STEADS<?= $suffix ?>_REGION_ID_ux
ON STEADS<?= $suffix ?> (REGION,ID);*/

ALTER TABLE STEADS
ATTACH PARTITION STEADS<?= $suffix ?> FOR VALUES IN (<?= $suffix ?>);