#!/bin/bash
#
# Run unit tests a la Drupal. Requires the container to be running.
#
set -e

docker-compose exec -T drupal /bin/bash -c 'drush en -y simpletest && cd /var/www/html && php core/scripts/run-tests.sh closest_zip_code'
