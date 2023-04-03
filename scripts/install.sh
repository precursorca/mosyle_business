#!/bin/bash

# mosyle_business controller
CTL="${BASEURL}index.php?/module/mosyle_business/"

# Get the scripts in the proper directories
"${CURL[@]}" "${CTL}get_script/mosyle_business.sh" -o "${MUNKIPATH}preflight.d/mosyle_business.sh"

# Check exit status of curl
if [ $? = 0 ]; then
	# Make executable
	chmod a+x "${MUNKIPATH}preflight.d/mosyle_business.sh"

	# Set preference to include this file in the preflight check
	setreportpref "mosyle_business" "${CACHEPATH}mosyle_business.txt"

else
	echo "Failed to download all required components!"
	rm -f "${MUNKIPATH}preflight.d/mosyle_business.sh"

	# Signal that we had an error
	ERR=1
fi
