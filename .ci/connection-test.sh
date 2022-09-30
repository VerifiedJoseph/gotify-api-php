
#!/bin/bash
# 
# Test connections to docker containers

sleep 5

connect()
{
	echo "Testing connection to ${1}"

	curl --retry 5 --retry-connrefused --retry-delay 10 ${1}
	if [ $? -ne 0 ]
		then
			echo "Failed. Aborting job";
			exit 1
	fi

	echo "OK"
}

connect ${GOTIFY_URI}
connect ${HTTPBIN_URI}
