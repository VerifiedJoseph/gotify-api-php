#!/bin/bash
# Create folder gotify-data/plugins then download plugin gotify-broadcast.
#
FOLDER=~/gotify-data/plugins
URL="https://github.com/eternal-flame-AD/gotify-broadcast/releases/download/v0.3.5/broadcasts-linux-amd64-for-gotify-v2.6.0.so"

mkdir -p $FOLDER

wget $URL -P $FOLDER
