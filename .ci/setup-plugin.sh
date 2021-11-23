#!/bin/bash
# Create gotify-data/plugins when download plugin gotify-broadcast
#
FOLDER=gotify-data/pulgins
URL="https://github.com/eternal-flame-AD/gotify-broadcast/releases/download/v0.3.1/broadcasts-linux-amd64-for-gotify-v2.0.23.so"

mkdir -p $FOLDER
cd $FOLDER

wget $URL