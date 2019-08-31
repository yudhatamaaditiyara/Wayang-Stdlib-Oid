<?php
/**
 * Copyright (C) 2019 Yudha Tama Aditiyara
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace Wayang\Stdlib\Oid;

/**
 */
class Oid563 extends AbstractOid
{
	/**
	 * @var array
	 */
	protected static $random;

	/**
	 * @var int
	 */
	protected static $sequence;

	/**
	 * @var int
	 */
	protected static $timeLength = 10;

	/**
	 * @var int
	 */
	protected static $randomLength = 6;

	/**
	 * @var int
	 */
	protected static $sequenceLength = 0xffffff;

	/**
	 * @param string|OidInterface $id
	 * @return bool
	 */
	public static function validate($id): bool{
		return preg_match('/^[0-9a-f]{28}$/', (string)$id);
	}

	/**
	 * @param int $time
	 * @return string
	 */
	public static function generate(int $time): string{
		$id = '';
		$random = static::getRandom();
		$sequence = static::getSequence();
		/* 5-byte time */
		$id .= static::$hex[($time >> 32) & 0xff];
		$id .= static::$hex[($time >> 24) & 0xff];
		$id .= static::$hex[($time >> 16) & 0xff];
		$id .= static::$hex[($time >> 8) & 0xff];
		$id .= static::$hex[$time & 0xff];
		/* 6-byte random */
		$id .= static::$hex[$random[0]];
		$id .= static::$hex[$random[1]];
		$id .= static::$hex[$random[2]];
		$id .= static::$hex[$random[3]];
		$id .= static::$hex[$random[4]];
		$id .= static::$hex[$random[5]];
		/* 3-byte sequence */
		$id .= static::$hex[($sequence >> 16) & 0xff];
		$id .= static::$hex[($sequence >> 8) & 0xff];
		$id .= static::$hex[$sequence & 0xff];
		return $id;
	}
}