#!/bin/bash
#
# This script is run when the Drupal docker container is ready. It prepares
# an environment for development or testing, which contains a full Drupal
# 8 installation with a running website and our custom module.
#
set -e

TRIES=20
echo "Will try to connect to MySQL container until it is up. This can take up to $TRIES seconds if the container has just been spun up."
OUTPUT="ERROR"
for i in $(seq 1 "$TRIES");
do
  OUTPUT=$(echo 'show databases'|{ mysql -h mysql -u root --password=drupal 2>&1 || true; })
  if [[ "$OUTPUT" == *"ERROR"* ]]; then
    echo "Try $i of $TRIES. MySQL container is not available yet. Should not be long..."
    sleep 1
  else
    echo "MySQL is up! Moving on..."
    break;
  fi
done

OUTPUT=$(echo 'select * from users limit 1'|{ mysql --user=root --password=drupal --database=drupal --host=mysql 2>&1 || true; })
if [[ "$OUTPUT" == *"ERROR"* ]]; then
  echo "Installing Drupal because we did not find an entry in the users table."
  drush si -y --db-url=mysql://root:drupal@mysql/drupal
  drush en -y devel closest_zip_code
else
  echo "Assuming Drupal is already running, because there is a users table with at least one entry."
fi
echo "Deployment of site OK; setting permissions for the file directory"
mkdir -p /var/www/html/sites/default/files
chown -R www-data:www-data /var/www/html/sites/default/files
