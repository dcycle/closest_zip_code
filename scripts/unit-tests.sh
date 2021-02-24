#!/bin/bash
#
# Run unit tests.
#

docker run --rm -v "$(pwd)":/app dcycle/phpunit:1 \
  --group closest_zip_code
