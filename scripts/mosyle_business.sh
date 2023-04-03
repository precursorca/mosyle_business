#!/bin/bash

# Script to collect data
# and put the data into outputfile

# Test for Mosyle Self-Service app exists
if [ -d "/Applications/Self-Service.app" ]; then

CWD=$(dirname $0)
CACHEDIR="$CWD/cache/"
OUTPUT_FILE="${CACHEDIR}mosyle_business.txt"
SEPARATOR=' = '

# Get the data
#Get current signed in user
 currentUser=$(ls -l /dev/console | awk '/ / { print $3 }')

# get uid logged in user
uid=$(id -u "${currentUser}")

if (( uid < 501 )); then
    exit 
fi

#com.mosyle.macos.business.plist location
MosyleBusinessFile=/Users/$currentUser/Library/Preferences/com.mosyle.macos.business.plist

# Business logic goes here
# Replace 'echo' in the following lines with the data collection commands for your module.
VERSION=$(defaults read /Applications/Self-Service.app/Contents/Info.plist CFBundleShortVersionString)
ORG_NAME=$(defaults read $MosyleBusinessFile com.mosyle.macos.business.school.schoolName)
LOCATION_ENABLED=$(defaults read $MosyleBusinessFile location.enabled)
ATTEMPT_DATE=$(defaults read $MosyleBusinessFile DeviceInfoAttemptDate)
SUCCESS_DATE=$(defaults read $MosyleBusinessFile DeviceInfoSuccessDate)

# Output data here
echo "version${SEPARATOR}${VERSION}" > ${OUTPUT_FILE}
echo "org_name${SEPARATOR}${ORG_NAME}" >> ${OUTPUT_FILE}
echo "attempt_date${SEPARATOR}${ATTEMPT_DATE}" >> ${OUTPUT_FILE}
echo "success_date${SEPARATOR}${SUCCESS_DATE}" >> ${OUTPUT_FILE}
echo "location_enabled${SEPARATOR}${LOCATION_ENABLED}" >> ${OUTPUT_FILE}

else
# There is no App so Remove the output file
rm -rf "${OUTPUT_FILE}"
fi