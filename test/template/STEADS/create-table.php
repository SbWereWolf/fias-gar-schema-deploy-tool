CREATE TABLE IF NOT EXISTS STEADS
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
)
PARTITION BY LIST (REGION);

/*CREATE UNIQUE INDEX STEADS_REGION_ID_ux
ON STEADS (REGION,ID);*/