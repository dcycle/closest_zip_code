#!/bin/bash
#
# Run all tests and linting.
#

set -e

echo '=> Linting code.'
./scripts/lint-sh.sh
./scripts/yaml-lint.sh
./scripts/lint-php.sh

echo '=> Unit tests.'
./scripts/unit-tests.sh

echo '=> Check for deprecated code'
./scripts/check-deprecated.sh

echo '=> Static analysis'
./scripts/php-static-analysis.sh
