#!/bin/bash
#
# Get a login link.
#
set -e

docker-compose exec drupal /bin/bash -c "drush -l http://$(docker-compose port webserver 80) uli"
