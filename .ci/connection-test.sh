
#!/bin/bash
# 
# Test connections to docker containers

connect()
{
	echo "Testing connection to ${1}"

	curl --retry 5 --retry-connrefused --retry-delay 2 -s -o /dev/null ${1}
	if [ $? -ne 0 ]
		then
			echo "Failed. Aborting job";
			exit 1

			echo "s";
	fi

	echo "OK"
}

connect ${GOTIFY_URI}
connect ${HTTPBIN_URI}
