<?php

namespace Drupal\closest_zip_code\ClosestZipCode;

use Drupal\closest_zip_code\traits\Singleton;
use Drupal\closest_zip_code\traits\CommonUtilities;

/**
 * Represents the data store.
 */
class DataStore {

  use Singleton;
  use CommonUtilities;

  /**
   * Given a zip code, get a latitude and longitude.
   *
   * @param string $zip
   *   A zip code.
   *
   * @return array
   *   An array with lat and lon keys.
   *
   * @throws Exception
   */
  public function latLon(string $zip) : array {
    $line = $this->line($zip);
    return [
      'lat' => $line[1],
      'lon' => $line[2],
    ];
  }

  /**
   * Get a line from the preloaded CSV file containing lat and lon for a zip.
   *
   * @param string $zip
   *   A zip code.
   *
   * @return array
   *   A line with 0 => zip, 1 => lat, 2 => lon.
   *
   * @throws Exception
   */
  protected function line(string $zip) : array {
    if (empty($this->lines[$zip])) {
      throw new \Exception(t('zip @z not found', ['@z' => $zip]));
    }
    return $this->lines[$zip];
  }

  /**
   * Preload all zip codes which will be used, for speedier execution.
   *
   * Stores the results internally.
   *
   * @param array $zips
   *   An array of zip codes.
   *
   * @throws Exception
   */
  public function preload(array $zips) {
    $this->lines = [];
    $zips = array_unique($zips);
    $handle = $this->fopen($this->drupalGetPath('module', 'closest_zip_code') . '/data/zipcodes.csv', 'r');
    while ($row = $this->fgetcsv($handle)) {
      if (in_array($row[0], $zips)) {
        $this->lines[$row[0]] = $row;
      }
      if (count($this->lines) == count($zips)) {
        break;
      }
    }
    $this->fclose($handle);
  }

}
