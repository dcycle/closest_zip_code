<?php

namespace Drupal\closest_zip_code\traits;

/**
 * Implements the Singleton design pattern.
 */
trait Singleton {

  /**
   * Interal instance variable used with the instance() method.
   *
   * @var object
   */
  static private $instance;

  /**
   * Implements the Singleton design pattern.
   *
   * Only one instance of the certain classes should exist per execution.
   *
   * @return object
   *   The single instance of the singleton.
   */
  public static function instance() {
    // See http://stackoverflow.com/questions/15443458
    $class = get_called_class();

    // Not sure why the linter tells me $instance is not used.
    // @codingStandardsIgnoreStart
    if (!$class::$instance) {
    // @codingStandardsIgnoreEnd
      $class::$instance = new $class();
    }
    return $class::$instance;
  }

}
