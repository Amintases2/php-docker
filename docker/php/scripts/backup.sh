chmod 0444 my.cnf
export MYSQL_PWD=root; mysqldump --user=root my_db | gzip > db_backup.tar.gz