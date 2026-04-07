#!/bin/bash

# Make sure package setup.sh is executable
chmod 777 ./galaxy/setup.sh

# Pre-update actions
# ...
./galaxy/setup.sh

# Post-update actions
# ...

# Notify done.
printf "✅  Setup completed.\n"
