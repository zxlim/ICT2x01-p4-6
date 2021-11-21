#!/usr/bin/env bash

SCRIPT_DIR=$(dirname $0)

if command -v php > /dev/null 2>&1; then
    cd ${SCRIPT_DIR}/src
    php -S 127.0.0.1:5000 -c ${SCRIPT_DIR}/config/php.ini
else
    echo "[!] Unable to find PHP. Please ensure that all dependencies are installed."
    echo "    Refer to ${SCRIPT_DIR}/README.md for instructions."
fi
