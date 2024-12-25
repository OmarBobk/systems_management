#!/bin/bash

# Define the composer.lock file path
FILE=$1

# Check if the file exists
if [[ ! -f "$FILE" ]]; then
  echo "Error: $FILE not found!"
  exit 1
fi

# Backup the original composer.lock file
cp "$FILE" "${FILE}.bak"
echo "Backup created: ${FILE}.bak"

# Use sed to remove conflict markers and related lines
# 1. Remove lines between (and including) "<<<<<<< HEAD" and "======="
# 2. Remove lines containing ">>>>>>> karman-dev"
sed -i '/<<<<<<< HEAD/,/=======/d' "$FILE"
sed -i '/>>>>>>> karman-dev/d' "$FILE"

echo "Conflict markers and unwanted lines removed from $FILE"
