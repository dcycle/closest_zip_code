<?php

namespace Drupal\closest_zip_code\Tests;

use Drupal\closest_zip_code\ClosestZipCode\DataStore;
use PHPUnit\Framework\TestCase;

/**
 * Test DataStore.
 *
 * @group myproject
 */
class DataStoreTest extends TestCase {

  /**
   * Smoke test.
   */
  public function testSmoke() {
    $object = $this->getMockBuilder(DataStore::class)
      // NULL = no methods are mocked; otherwise list the methods here.
      ->setMethods(NULL)
      ->disableOriginalConstructor()
      ->getMock();

    $this->assertTrue(is_object($object));
  }

}
