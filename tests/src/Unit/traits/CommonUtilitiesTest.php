<?php

namespace Drupal\Tests\closest_zip_code\Unit\traits;

use Drupal\closest_zip_code\traits\CommonUtilities;
use PHPUnit\Framework\TestCase;

class DummyClassUsesCommonUtilities {
  use CommonUtilities;
}

/**
 * Test CommonUtilities.
 *
 * @group closest_zip_code
 */
class CommonUtilitiesTest extends TestCase {

  /**
   * Smoke test.
   */
  public function testSmoke() {
    $object = new DummyClassUsesCommonUtilities();

    $this->assertTrue(is_object($object));
  }

}
