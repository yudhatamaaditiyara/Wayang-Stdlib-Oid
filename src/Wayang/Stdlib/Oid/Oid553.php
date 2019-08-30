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
class Oid553 extends AbstractOid
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
	 * @return int
	 */
	public function getTimestamps(): int{
		if ($this->timestamps === null) {
			$this->timestamps = hexdec(substr($this->id, 0, 10));
		}
		return $this->timestamps;
	}

	/**
	 * @param string|OidInterface $id
	 * @return bool
	 */
	public static function validate($id): bool{
		return preg_match('/^[0-9a-f]{26}$/', (string)$id);
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
		$id .= static::$hexMap[($time >> 32) & 0xff];
		$id .= static::$hexMap[($time >> 24) & 0xff];
		$id .= static::$hexMap[($time >> 16) & 0xff];
		$id .= static::$hexMap[($time >> 8) & 0xff];
		$id .= static::$hexMap[$time & 0xff];
		/* 5-byte random */
		$id .= static::$hexMap[$random[1]];
		$id .= static::$hexMap[$random[2]];
		$id .= static::$hexMap[$random[3]];
		$id .= static::$hexMap[$random[4]];
		$id .= static::$hexMap[$random[5]];
		/* 3-byte sequence */
		$id .= static::$hexMap[($sequence >> 16) & 0xff];
		$id .= static::$hexMap[($sequence >> 8) & 0xff];
		$id .= static::$hexMap[$sequence & 0xff];
		return $id;
	}

	/**
	 * @return array
	 */
	public static function getRandom(): array{
		if (static::$random === null) {
			static::$random = unpack('C5', random_bytes(5));
		}
		return static::$random;
	}

	/**
	 * @return int
	 */
	public static function getSequence(): int{
		if (static::$sequence === null) {
			static::$sequence = rand(0, 0xffffffff);
		}
		return static::$sequence = static::$sequence++ % 0xffffffff;
	}
}