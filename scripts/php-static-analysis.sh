#!/bin/bash
#
# See https://github.com/dcycle/docker-phpstan-drupal.
#
set -e

echo '=> Static analysis of PHP code.'
echo 'If you are getting a false negative, use:'
echo ''
echo '// @phpstan-ignore-next-line'
echo ''

docker run --rm \
  -v "$PWD":/var/www/html/modules/custom/closest_zip_code \
  -v "$PWD"/scripts/lib/phpstan-drupal:/phpstan-drupal \
  dcycle/phpstan-drupal:2 /var/www/html/modules/custom \
  -c /phpstan-drupal/phpstan.neon
