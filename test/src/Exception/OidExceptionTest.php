<?php declare(strict_types=1);
/**
 * Copyright 2019 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace WayangTest\Stdlib\Oid\Exception;

use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Wayang\Stdlib\Oid\Exception\OidException;
use Wayang\Stdlib\Oid\Exception\ExceptionInterface;

class OidExceptionTest extends TestCase
{
  public function testMustBeClass(){
    $rc = new ReflectionClass(OidException::class);
    $this->assertFalse($rc->isTrait());
    $this->assertFalse($rc->isInterface());
  }

  public function testMustBeSubclassOfRuntimeException(){
    $rc = new ReflectionClass(OidException::class);
    $this->assertTrue($rc->isSubclassOf(\RuntimeException::class));
  }

  public function testMustBeImplemetsExceptionInterface(){
    $rc = new ReflectionClass(OidException::class);
    $this->assertTrue($rc->implementsInterface(ExceptionInterface::class));
  }
}