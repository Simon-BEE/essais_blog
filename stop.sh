#!/bin/bash
docker-compose stop
sleep 3;
docker-compose rm -f

echo
echo "#-----------DELETED-----------#"
echo

exit 0