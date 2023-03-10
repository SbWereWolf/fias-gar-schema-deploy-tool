CREATE TABLE IF NOT EXISTS ADDRESSOBJECTS
(
REGION BIGINT,
ID BIGINT,
OBJECTID BIGINT,
OBJECTGUID TEXT,
CHANGEID BIGINT,
NAME TEXT,
TYPENAME TEXT,
LEVEL BIGINT,
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

/*CREATE UNIQUE INDEX ADDRESSOBJECTS_REGION_ID_ux
ON ADDRESSOBJECTS (REGION,ID);*/