CREATE TABLE IF NOT EXISTS HOUSETYPES
(
ID BIGINT,
NAME TEXT,
SHORTNAME TEXT,
DESCR TEXT,
UPDATEDATE DATE,
STARTDATE DATE,
ENDDATE DATE,
ISACTIVE BIGINT
);

/*CREATE UNIQUE INDEX HOUSETYPES_ID_ux
ON HOUSETYPES (ID);*/