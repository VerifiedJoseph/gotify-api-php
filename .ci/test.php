<?php

if(file_exists('/home/runner/gotify-data\plugins/broadcasts-linux-amd64-for-gotify-v2.0.23.so')) {
	echo "Found file";
} else {
	echo "Not found file";
	exit(1);
}
