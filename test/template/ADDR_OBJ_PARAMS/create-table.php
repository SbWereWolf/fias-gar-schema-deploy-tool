CREATE TABLE IF NOT EXISTS ADDR_OBJ_PARAMS
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

/*CREATE UNIQUE INDEX ADDR_OBJ_PARAMS_REGION_ID_ux
ON ADDR_OBJ_PARAMS (REGION,ID);*/