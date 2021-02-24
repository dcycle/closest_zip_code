#!/bin/bash
#
# Run tests on Circle CI.
#

echo '=> Run fast tests.'
./scripts/test.sh

echo '=> Deploy a Drupal 9 environment.'
./scripts/deploy.sh

echo '=> Drupal PHPUnit tests on required Drupal 9 environment.'
./scripts/php-unit-drupal.sh

echo '=> Destroy the Drupal 9 environment.'
./scripts/destroy.sh

echo '=> Deploy a Drupal 8 environment.'
./scripts/deploy.sh 8

echo '=> Drupal PHPUnit tests on required Drupal 9 environment.'
./scripts/php-unit-drupal.sh

echo '=> Destroy the Drupal 8 environment.'
./scripts/destroy.sh
