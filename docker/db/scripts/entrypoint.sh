#!/bin/bash

echo 'start creating db'
mysql -uroot -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE < testdb.sql
echo 'db was created successful'
