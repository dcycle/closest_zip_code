#!/bin/bash
#
# Lint php files.
#

echo 'Linting PHP files with https://github.com/dcycle/docker-php-lint'
echo 'If you are getting a false positive, use:'
echo ''
echo '// @codingStandardsIgnoreStart'
echo '...'
echo '// @codingStandardsIgnoreEnd'
echo ''
echo 'To automatically fix errors, you can run:'
echo ''
echo './scripts/lint-php-fix.sh'
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
