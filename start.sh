#!/bin/bash
docker-compose build
docker-compose -f docker-compose.yml up -d

echo
echo "#-----------CREATED-----------#"
echo

exit 0