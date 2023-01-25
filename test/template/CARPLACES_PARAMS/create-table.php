CREATE TABLE IF NOT EXISTS CARPLACES_PARAMS
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
)
PARTITION BY LIST (REGION);

/*CREATE UNIQUE INDEX CARPLACES_PARAMS_REGION_ID_ux
ON CARPLACES_PARAMS (REGION,ID);*/