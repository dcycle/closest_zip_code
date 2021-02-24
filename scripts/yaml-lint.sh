#!/bin/bash
#
# Lint YAML files.
#
set -e

echo '=> Linting YAML files.'
# See https://github.com/dcycle/docker-yaml-lint
find . -name "*.yml" -not -path "*scripts/lib/docker-resources/dev-config*" -print0 | tr '\n' '\0' | xargs -0 -I '$' docker run --rm -v "$(pwd)":/app/code dcycle/yaml-lint:2 -s "code/$"
