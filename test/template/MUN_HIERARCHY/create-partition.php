CREATE TABLE IF NOT EXISTS MUN_HIERARCHY<?= $suffix ?>
(
REGION BIGINT,
ID BIGINT,
OBJECTID BIGINT,
PARENTOBJID BIGINT,
CHANGEID BIGINT,
OKTMO TEXT,
PREVID BIGINT,
NEXTID BIGINT,
UPDATEDATE DATE,
STARTDATE DATE,
ENDDATE DATE,
ISACTIVE BIGINT,
PATH TEXT
);

/*CREATE UNIQUE INDEX MUN_HIERARCHY<?= $suffix ?>_REGION_ID_ux
ON MUN_HIERARCHY<?= $suffix ?> (REGION,ID);*/

ALTER TABLE MUN_HIERARCHY
ATTACH PARTITION MUN_HIERARCHY<?= $suffix ?> FOR
VALUES IN (<?= $suffix ?>);