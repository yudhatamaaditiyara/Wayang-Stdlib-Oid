<?php declare(strict_types=1);
/**
 * Copyright 2019 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace WayangTest\Stdlib\Oid;

use Throwable;
use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Wayang\Stdlib\Oid\AbstractOid;
use Wayang\Stdlib\Oid\OidInterface;
use Wayang\Stdlib\Oid\Exception\BadMethodCallException;

class AbstractOidTest extends TestCase
{
  public function testMustBeClass(){
    $rc = new ReflectionClass(AbstractOid::class);
    $this->assertFalse($rc->isTrait());
    $this->assertFalse($rc->isInterface());
  }

  public function testMustBeAbstractClass(){
    $rc = new ReflectionClass(AbstractOid::class);
    $this->assertTrue($rc->isAbstract());
  }

  public function testMustBeImplemetsOidInterface(){
    $rc = new ReflectionClass(AbstractOid::class);
    $this->assertTrue($rc->implementsInterface(OidInterface::class));
  }

  public function testValidateMustBeThrowBadMethodCallException(){
    try {
      AbstractOid::validate('');
    } catch (Throwable $e) {
      $this->assertInstanceOf(BadMethodCallException::class, $e);
      return;
    }
    $this->assertTrue(false);
  }

  public function testGenerateMustBeThrowBadMethodCallException(){
    try {
      AbstractOid::generate(0);
    } catch (Throwable $e) {
      $this->assertInstanceOf(BadMethodCallException::class, $e);
      return;
    }
    $this->assertTrue(false);
  }
}