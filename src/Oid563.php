<?php declare(strict_types=1);
/**
 * Copyright 2019 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace Wayang\Stdlib\Oid;

class Oid563 extends AbstractOid
{
  /**
   * @var int
   */
  protected $byteSize = 14;
  
  /**
   * @var int
   */
  protected $charSize = 28;

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
    return !!preg_match('/^[0-9a-f]{28}$/', (string)$id);
  }

  /**
   * @param int $timestamp
   * @return string
   */
  public static function generate(int $timestamp): string{
    $id = '';
    $random = static::getRandom();
    $sequence = static::getSequence();
    /* 5-byte time */
    $id .= static::$hexTable[($timestamp / 0x100000000) & 0xff];
    $id .= static::$hexTable[($timestamp >> 24) & 0xff];
    $id .= static::$hexTable[($timestamp >> 16) & 0xff];
    $id .= static::$hexTable[($timestamp >> 8) & 0xff];
    $id .= static::$hexTable[$timestamp & 0xff];
    /* 6-byte random */
    $id .= static::$hexTable[$random[1]];
    $id .= static::$hexTable[$random[2]];
    $id .= static::$hexTable[$random[3]];
    $id .= static::$hexTable[$random[4]];
    $id .= static::$hexTable[$random[5]];
    $id .= static::$hexTable[$random[6]];
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
      static::$random = unpack('C*', random_bytes(6));
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