#!/bin/bash
#
# Check for deprecated code.
#
set -e

docker run --rm -v "$(pwd)":/var/www/html/modules/closest_zip_code dcycle/drupal-check:1 closest_zip_code/src
