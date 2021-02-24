<?php

namespace Drupal\Tests\closest_zip_code\Unit\traits;

use Drupal\closest_zip_code\traits\Singleton;
use PHPUnit\Framework\TestCase;

class DummyClassUsesSingleton {
  use Singleton;
}

/**
 * Test CommonUtilities.
 *
 * @group closest_zip_code
 */
class SingletonTest extends TestCase {

  /**
   * Smoke test.
   */
  public function testSmoke() {
    $this->assertTrue(DummyClassUsesSingleton::instance() === DummyClassUsesSingleton::instance());
  }

}
