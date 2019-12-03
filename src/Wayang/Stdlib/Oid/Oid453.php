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
        return preg_match('/^[0-9a-f]{24}$/', (string)$id);
    }

    /**
     * @param int $time
     * @return string
     */
    public static function generate(int $time): string{
        $id = '';
        $random = static::getRandom();
        $sequence = static::getSequence();
        /* 4-byte time */
        $id .= static::$hexTable[($time >> 24) & 0xff];
        $id .= static::$hexTable[($time >> 16) & 0xff];
        $id .= static::$hexTable[($time >> 8) & 0xff];
        $id .= static::$hexTable[$time & 0xff];
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