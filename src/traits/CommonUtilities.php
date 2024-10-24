<?php

namespace Drupal\closest_zip_code\traits;

use Drupal\Core\Logger\RfcLogLevel;
use Drupal\Core\Utility\Error;
use Drupal\closest_zip_code\ClosestZipCode\DataStore;

/**
 * General utilities trait.
 *
 * If your class needs to use any of these, add "use CommonUtilities" your class
 * and these methods will be available and mockable in tests.
 */
trait CommonUtilities {

  /**
   * Get the data store singleton.
   *
   * @return \Drupal\closest_zip_code\ClosestZipCode\DataStore
   *   The DataStore singleton.
   */
  public function dataStore(): DataStore {
    return DataStore::instance();
  }

  /**
   * Mockable wrapper around microtime().
   */
  public function microtime(bool $get_as_float = FALSE) {
    return microtime($get_as_float);
  }

  /**
   * Mockable wrapper around t().
   */
  public function t($string, array $args = []) {
    // @codingStandardsIgnoreStart
    return t($string, $args);
    // @codingStandardsIgnoreEnd
  }

  /**
   * Log a string to the watchdog.
   *
   * @param string $string
   *   String to be logged.
   *
   * @throws \Exception
   */
  public function watchdog(string $string) {
    \Drupal::logger('steward_common')->notice($string);
  }

  /**
   * Log an error to the watchdog.
   *
   * @param string $string
   *   String to be logged.
   *
   * @throws \Exception
   */
  public function watchdogError(string $string) {
    \Drupal::logger('steward_common')->error($string);
  }

  /**
   * Log a \Throwable to the watchdog.
   *
   * @param \Throwable $t
   *   A \throwable.
   * @param mixed $message
   *   See https://api.drupal.org/api/drupal/core%21includes%21bootstrap.inc/function/watchdog_exception/8.2.x.
   * @param array $variables
   *   See https://api.drupal.org/api/drupal/core%21includes%21bootstrap.inc/function/watchdog_exception/8.2.x.
   * @param mixed $severity
   *   See https://api.drupal.org/api/drupal/core%21includes%21bootstrap.inc/function/watchdog_exception/8.2.x.
   * @param mixed $link
   *   See https://api.drupal.org/api/drupal/core%21includes%21bootstrap.inc/function/watchdog_exception/8.2.x.
   */
  public function watchdogThrowable(\Throwable $t, $message = NULL, array $variables = [], $severity = RfcLogLevel::ERROR, $link = NULL) {

    // Use a default value if $message is not set.
    if (empty($message)) {
      $message = '%type: @message in %function (line %line of %file).';
    }

    if ($link) {
      $variables['link'] = $link;
    }

    $variables += Error::decodeException($t);

    \Drupal::logger('steward_common')->log($severity, $message, $variables);
  }

  /**
   * Mockable wrapper around fopen().
   */
  public function fopen(string $filename, string $mode) {
    $return = fopen($filename, $mode);
    if (!$return) {
      throw new \Exception('fopen() returned FALSE');
    }
    return $return;
  }

  /**
   * Mockable wrapper around \Drupal::service('extension.path.resolver').
   */
  public function extensionPathResolver() {
    return \Drupal::service('extension.path.resolver');
  }

  /**
   * Mockable wrapper around drupal_get_path().
   */
  public function drupalGetPath(string $type, string $name) : string {
    $return = $this->extensionPathResolver()->getPath($type, $name);
    if (!$return) {
      throw new \Exception('drupal_get_path() returned an empty string');
    }
    return $return;
  }

  /**
   * Mockable wrapper around fgetcsv().
   */
  public function fgetcsv($handle) {
    return fgetcsv($handle);
  }

  /**
   * Mockable wrapper around fclose().
   */
  public function fclose($handle) {
    $return = fclose($handle);
    if (!$return) {
      throw new \Exception('fclose() failure');
    }
    return $return;
  }

}
