<?php

namespace Drupal\Tests\closest_zip_code\Unit\ClosestZipCode;

use Drupal\closest_zip_code\ClosestZipCode\Location;
use PHPUnit\Framework\TestCase;

/**
 * Test Location.
 *
 * @group closest_zip_code
 */
class LocationTest extends TestCase {

  /**
   * Smoke test.
   */
  public function testSmoke() {
    $object = $this->getMockBuilder(Location::class)
      // NULL = no methods are mocked; otherwise list the methods here.
      ->setMethods(NULL)
      ->disableOriginalConstructor()
      ->getMock();

    $this->assertTrue(is_object($object));
  }

}
