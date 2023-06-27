#!/bin/bash
#
# Run tests on Circle CI.
#
set -e

echo '=> Run fast tests.'
./scripts/test.sh

echo '=> Deploy a Drupal 9 environment.'
./scripts/deploy.sh 9

echo '=> Destroy the Drupal 9 environment.'
./scripts/destroy.sh

echo '=> Deploy a Drupal 10 environment.'
./scripts/deploy.sh 10

echo '=> Destroy the Drupal 10 environment.'
./scripts/destroy.sh
