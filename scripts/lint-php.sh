#!/bin/bash
#
# Lint php files.
#

echo 'Linting PHP files'
echo 'If you are getting a false negative, use:'
echo ''
echo '// @codingStandardsIgnoreStart'
echo '...'
echo '// @codingStandardsIgnoreEnd'
echo ''

docker run --rm \
  -v "$(pwd)"/src:/code \
  dcycle/php-lint:3 \
  --standard=DrupalPractice \
  /code
docker run --rm \
  -v "$(pwd)"/src:/code \
  dcycle/php-lint:3 \
  --standard=Drupal \
  /code
