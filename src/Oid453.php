<?php declare(strict_types=1);
/**
 * Copyright 2019 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace Wayang\Stdlib\Oid;

class Oid453 extends AbstractOid
{
  /**
   * @var int
   */
  protected $byteSize = 12;
  
  /**
   * @var int
   */
  protected $charSize = 24;

  /**
   * @var array
   */
  protected static $random;

  /**
   * @var int
   */
  protected static $sequence;

  /**
   * @param string|OidInterface $id
   * @return bool
   */
  public static function validate($id): bool{
    return !!preg_match('/^[0-9a-f]{24}$/', (string)$id);
  }

  /**
   * @param int $timestamp
   * @return string
   */
  public static function generate(int $timestamp): string{
    $id = '';
    $random = static::getRandom();
    $sequence = static::getSequence();
    /* 4-byte time */
    $id .= static::$hexTable[($timestamp >> 24) & 0xff];
    $id .= static::$hexTable[($timestamp >> 16) & 0xff];
    $id .= static::$hexTable[($timestamp >> 8) & 0xff];
    $id .= static::$hexTable[$timestamp & 0xff];
    /* 5-byte random */
    $id .= static::$hexTable[$random[1]];
    $id .= static::$hexTable[$random[2]];
    $id .= static::$hexTable[$random[3]];
    $id .= static::$hexTable[$random[4]];
    $id .= static::$hexTable[$random[5]];
    /* 3-byte sequence */
    $id .= static::$hexTable[($sequence >> 16) & 0xff];
    $id .= static::$hexTable[($sequence >> 8) & 0xff];
    $id .= static::$hexTable[$sequence & 0xff];
    return $id;
  }

  /**
   * @return array
   */
  protected static function getRandom(): array{
    if (static::$random === null) {
      static::$random = unpack('C*', random_bytes(5));
    }
    return static::$random;
  }

  /**
   * @return int
   */
  protected static function getSequence(): int{
    if (static::$sequence === null) {
      static::$sequence = rand(0, 0xffffff);
    }
    return static::$sequence = (static::$sequence + 1) % 0xffffff;
  }
}