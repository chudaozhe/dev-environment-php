 dir='/data/backup/'`date +%Y%m%d`;
 filename='all_mysql'`date +%Y%m%d%H%M`'.sql.gz';
 mkdir $dir
 cd $dir
 mysql -e "show databases;" -uroot | grep -Ev "Database|mysql|information_schema|performance_schema|tmp" > databases.txt
 mysql -e "show databases;" -uroot | grep -Ev "Database|mysql|information_schema|performance_schema|tmp" | xargs mysqldump --skip-lock-tables -uroot --databases | gzip> $filename
