#!/usr/bin/env bash

SCRIPT_DIR=$(dirname $0)

cd ${SCRIPT_DIR}/src
php -S 127.0.0.1:5000 -c ${SCRIPT_DIR}/config/php.ini
