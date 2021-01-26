<?php declare(strict_types=1);
/**
 * Copyright 2019 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace WayangTest\Stdlib\Oid\Exception;

use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Wayang\Stdlib\Oid\Exception\BadMethodCallException;
use Wayang\Stdlib\Oid\Exception\ExceptionInterface;

class BadMethodCallExceptionTest extends TestCase
{
  public function testMustBeClass(){
    $rc = new ReflectionClass(BadMethodCallException::class);
    $this->assertFalse($rc->isTrait());
    $this->assertFalse($rc->isInterface());
  }

  public function testMustBeSubclassOfRuntimeException(){
    $rc = new ReflectionClass(BadMethodCallException::class);
    $this->assertTrue($rc->isSubclassOf(\BadMethodCallException::class));
  }

  public function testMustBeImplemetsExceptionInterface(){
    $rc = new ReflectionClass(BadMethodCallException::class);
    $this->assertTrue($rc->implementsInterface(ExceptionInterface::class));
  }
}