#!/bin/bash

# Make sure package deploy.sh is executable
chmod 777 ./galaxy/deploy.sh

# Pre-update actions
# ...
./galaxy/deploy.sh

# Post-update actions
# ...

# Notify done.
printf "✅  Deploy completed. The server has been instructed to update their files! This will take approximately one minute.\n"
