SELECT CONNECTION_ID();
SHOW VARIABLES;
/* Changing character set from utf8mb4 to utf8mb4 */
/* Set di caratteri: utf8mb4 */
SHOW /*!50002 GLOBAL */ STATUS;
SELECT NOW();
/* Connesso. ID thread: 19322 */
/* Reading function definitions from C:\Program Files\HeidiSQL\functions-mysql8.ini */
SHOW TABLES FROM `information_schema`;
SHOW DATABASES;
/* Collegamento alla sessione “database” */
/* Ridimensionamento dei controlli ai DPI dello schermo: 100% */
USE `a_fisioq`;
SELECT `DEFAULT_COLLATION_NAME` FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME`='a_fisioq';
SHOW TABLE STATUS FROM `a_fisioq`;
SHOW FUNCTION STATUS WHERE `Db`='a_fisioq';
SHOW PROCEDURE STATUS WHERE `Db`='a_fisioq';
SHOW TRIGGERS FROM `a_fisioq`;
SELECT *, EVENT_SCHEMA AS `Db`, EVENT_NAME AS `Name` FROM information_schema.`EVENTS` WHERE `EVENT_SCHEMA`='a_fisioq';
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='a_fisioq' AND TABLE_NAME='anagrafica_dottori' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `anagrafica_dottori` FROM `a_fisioq`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='a_fisioq'   AND TABLE_NAME='anagrafica_dottori'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='a_fisioq'   AND TABLE_NAME='anagrafica_dottori'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW COLLATION;
SHOW ENGINES;
SHOW CREATE TABLE `a_fisioq`.`anagrafica_dottori`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='a_fisioq' AND tc.TABLE_NAME='anagrafica_dottori' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='a_fisioq' AND TABLE_NAME='anagrafica_pazienti' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `anagrafica_pazienti` FROM `a_fisioq`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='a_fisioq'   AND TABLE_NAME='anagrafica_pazienti'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='a_fisioq'   AND TABLE_NAME='anagrafica_pazienti'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `a_fisioq`.`anagrafica_pazienti`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='a_fisioq' AND tc.TABLE_NAME='anagrafica_pazienti' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;