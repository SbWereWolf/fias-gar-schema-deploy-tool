CREATE UNIQUE INDEX REESTR_OBJECTS<?= $suffix ?>_REGION_OBJECTID_ux
ON REESTR_OBJECTS<?= $suffix ?> (REGION,OBJECTID);