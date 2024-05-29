#!/bin/bash

echo 'start backup'
/usr/bin/mysqldump -uroot --password=$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE > testdb.sql
echo 'backup succes testdb.sql'
