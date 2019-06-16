#!/bin/bash
docker-compose build
docker-compose -f docker-compose.yml up -d

sleep 4;

docker exec blog composer update

docker exec blog php commandes/createsql.php

echo
echo "#-----------CREATED-----------#"
echo

exit 0