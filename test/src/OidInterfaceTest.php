<?php declare(strict_types=1);
/**
 * Copyright 2019 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace WayangTest\Stdlib\Oid;

use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Wayang\Stdlib\StringableInterface;
use Wayang\Stdlib\Oid\OidInterface;

class OidInterfaceTest extends TestCase
{
  public function testMustBeInterface(){
    $rc = new ReflectionClass(OidInterface::class);
    $this->assertTrue($rc->isInterface());
  }

  public function testMustBeSubclassOfStringableInterface(){
    $rc = new ReflectionClass(OidInterface::class);
    $this->assertTrue($rc->isSubclassOf(StringableInterface::class));
  }
}