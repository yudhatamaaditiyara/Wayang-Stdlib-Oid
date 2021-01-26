<?php declare(strict_types=1);
/**
 * Copyright 2019 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace WayangTest\Stdlib\Oid;

use Throwable;
use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Wayang\Stdlib\Oid\Oid563;
use Wayang\Stdlib\Oid\AbstractOid;
use Wayang\Stdlib\Oid\Exception\OidException;

class Oid563Test extends TestCase
{
  const MIN_ID = '0000000000000000000000000000';
  const MAX_ID = 'ffffffffffffffffffffffffffff';
  const INVALID_HEX_CHARACTER_ID = 'ghijklmn00000000000000000000';
  const INVALID_HEX_SENSITIVE_ID = 'FFFFFFFF00000000000000000000';
  const MIN_TIMESTAMP = 0;
  const MAX_TIMESTAMP = 0xffffffffff;

  public function testMustBeClass(){
    $rc = new ReflectionClass(Oid563::class);
    $this->assertFalse($rc->isTrait());
    $this->assertFalse($rc->isInterface());
  }

  public function testMustBeSubclassOfAbstractOid(){
    $rc = new ReflectionClass(Oid563::class);
    $this->assertTrue($rc->isSubclassOf(AbstractOid::class));
  }

  public function testCreate(){
    $timestamp = time();
    $oid = Oid563::create();
    $this->assertGreaterThanOrEqual($oid->getTimestamp(), $timestamp);
  }

  public function testCreateFromString(){
    $oid = Oid563::createFromString(static::MIN_ID);
    $this->assertEquals($oid->getId(), static::MIN_ID);
  }

  public function testCreateFromTimestamp(){
    $oid = Oid563::createFromTimestamp(static::MAX_TIMESTAMP);
    $this->assertEquals($oid->getTimestamp(), static::MAX_TIMESTAMP);
  }

  public function testGenerate(){
    $timestamp = time();
    $oid = new Oid563(Oid563::generate($timestamp));
    $this->assertEquals($oid->getTimestamp(), $timestamp);
  }

  public function testMinId(){
    $oid = new Oid563(static::MIN_ID);
    $this->assertEquals($oid->getId(), static::MIN_ID);
    $this->assertEquals($oid->getByteSize(), 14);
    $this->assertEquals($oid->getCharSize(), 28);
    $this->assertEquals($oid->getTimestamp(), static::MIN_TIMESTAMP);
    $this->assertEquals((string)$oid, static::MIN_ID);
  }

  public function testMaxId(){
    $oid = new Oid563(static::MAX_ID);
    $this->assertEquals($oid->getId(), static::MAX_ID);
    $this->assertEquals($oid->getByteSize(), 14);
    $this->assertEquals($oid->getCharSize(), 28);
    $this->assertEquals($oid->getTimestamp(), static::MAX_TIMESTAMP);
    $this->assertEquals((string)$oid, static::MAX_ID);
  }

  public function testInvalidHexCharacterId(){
    try {
      Oid563::createFromString(static::INVALID_HEX_CHARACTER_ID);
    } catch (Throwable $e) {
      $this->assertInstanceOf(OidException::class, $e);
      return;
    }
    $this->assertTrue(false);
  }

  public function testInvalidHexSensitiveId(){
    try {
      Oid563::createFromString(static::INVALID_HEX_SENSITIVE_ID);
    } catch (Throwable $e) {
      $this->assertInstanceOf(OidException::class, $e);
      return;
    }
    $this->assertTrue(false);
  }

  public function testTimestampUint8(){
    $timestamp = (2 ** 8) - 1;
    $oid = Oid563::createFromTimestamp($timestamp);
    $this->assertEquals($oid->getTimestamp(), $timestamp);
  }

  public function testTimestampUint16(){
    $timestamp = (2 ** 16) - 1;
    $oid = Oid563::createFromTimestamp($timestamp);
    $this->assertEquals($oid->getTimestamp(), $timestamp);
  }

  public function testTimestampUint24(){
    $timestamp = (2 ** 24) - 1;
    $oid = Oid563::createFromTimestamp($timestamp);
    $this->assertEquals($oid->getTimestamp(), $timestamp);
  }

  public function testTimestampUint32(){
    $timestamp = (2 ** 32) - 1;
    $oid = Oid563::createFromTimestamp($timestamp);
    $this->assertEquals($oid->getTimestamp(), $timestamp);
  }

  public function testTimestampUint40(){
    $timestamp = (2 ** 40) - 1;
    $oid = Oid563::createFromTimestamp($timestamp);
    $this->assertEquals($oid->getTimestamp(), static::MAX_TIMESTAMP);
  }

  public function testTimestampUint48(){
    $timestamp = (2 ** 48) - 1;
    $oid = Oid563::createFromTimestamp($timestamp);
    $this->assertEquals($oid->getTimestamp(), static::MAX_TIMESTAMP);
  }
}