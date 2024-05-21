export MYSQL_PWD=$MYSQL_ROOT_PASSWORD; mysql --user=root --execute \
"
CREATE DATABASE IF NOT EXISTS $MYSQL_DATABASE;

use $MYSQL_DATABASE;

CREATE TABLE IF NOT EXISTS es_table (
  id BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY unique_id (id),
  client_name VARCHAR(32) NOT NULL,
  modification_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO es_table (id, client_name)
    VALUES (1,'Targaryen'),
    (2,'Lannister'),
    (3,'Stark');
"
