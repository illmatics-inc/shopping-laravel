#!/bin/bash

if [ "$(uname)" == 'Darwin' ]; then
  OS='Mac'
elif [ "$(expr substr $(uname -s) 1 5)" == 'Linux' ]; then
  OS='Linux'
else
  echo "Your platform ($(uname -a)) is not supported."
  exit 1
fi

SCRIPT_DIR=$(cd $(dirname $0); pwd)

cp $SCRIPT_DIR/laradock/.env.example $SCRIPT_DIR/laradock/.env
case "$OS" in
  'Mac' )
    sed -i '' 's!^APP_CODE_PATH_HOST=.*$!APP_CODE_PATH_HOST=../application!' $SCRIPT_DIR/laradock/.env
    sed -i '' 's!^DATA_PATH_HOST=.*$!DATA_PATH_HOST=../.laradock/data!' $SCRIPT_DIR/laradock/.env
    ;;
  'Linux' )
    sed -i 's!^APP_CODE_PATH_HOST=.*$!APP_CODE_PATH_HOST=../application!' $SCRIPT_DIR/laradock/.env
    sed -i 's!^DATA_PATH_HOST=.*$!DATA_PATH_HOST=../.laradock/data!' $SCRIPT_DIR/laradock/.env
    ;;
esac
#cp $SCRIPT_DIR/initfile/mysql/Dockerfile $SCRIPT_DIR/laradock/mysql/
#cp $SCRIPT_DIR/initfile/mysql/my.cnf $SCRIPT_DIR/laradock/mysql/
