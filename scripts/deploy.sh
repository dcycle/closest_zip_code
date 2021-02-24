#!/bin/bash
#
# Assuming you have the latest version Docker installed, this script will
# fully create or update your development environment.
#
set -e

echo ''
echo 'About to try to get the latest version of'
echo 'https://hub.docker.com/r/dcycle/drupal/ from the Docker hub. This image'
echo 'is updated automatically every Wednesday with the latest version of'
echo 'Drupal and Drush. If the image has changed since the latest deployment,'
echo 'the environment will be completely rebuild based on this image.'
if [ "$1" == 8 ]; then
  DRUPALVERSION=8
  docker pull dcycle/drupal:8drush
else
  DRUPALVERSION=9
  docker pull dcycle/drupal:9
fi

echo ''
echo '-----'
echo 'About to start persistent (-d) containers based on the images defined'
echo 'in ./Dockerfile-* files. We are also telling docker-compose to'
echo 'rebuild the images if they are out of date.'
docker-compose -f docker-compose.yml -f docker-compose.drupal"$DRUPALVERSION".yml up -d --build

echo ''
echo '-----'
echo 'Running the deploy script on the running containers. This installs'
echo 'Drupal if it is not yet installed.'
docker-compose exec drupal /docker-resources/scripts/deploy-on-container.sh

echo ''
echo '-----'
echo ''
echo 'If all went well you can now access your site at:'
./scripts/uli.sh
echo '-----'
echo ''
