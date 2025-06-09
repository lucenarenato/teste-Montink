#!/usr/bin/env bash

mysql --user=root --password="$MYSQL_ROOT_PASSWORD" <<-EOSQL
    CREATE DATABASE IF NOT EXISTS teste;
    GRANT ALL PRIVILEGES ON \`teste%\`.* TO '$MYSQL_USER'@'%';

    GRANT ALL PRIVILEGES
    ON teste.*
    TO 'sail'@'%'
    WITH GRANT OPTION;

    FLUSH PRIVILEGES;

EOSQL
