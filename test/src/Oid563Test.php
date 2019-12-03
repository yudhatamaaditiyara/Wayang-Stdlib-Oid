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

use PHPUnit\Framework\TestCase;
use Wayang\Exception\Spl\InvalidArgumentException;

class Oid563Test extends TestCase
{
    public function testConstructor(){
        $id = Oid563::generate(time());
        $object = new Oid563($id);
        $this->assertEquals($object->getId(), $id);
    }

    public function testConstructorThrowInvalidArgumentException(){
        try {
            new Oid563(Oid453::generate(time()));
            $this->assertTrue(false);
        } catch (InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
    }

    public function testCreate(){
        $object = Oid563::create();
        $this->assertTrue($object instanceof OidInterface);
    }

    public function testValidate(){
        $this->assertTrue(Oid563::validate(Oid563::create()));
    }

    public function testValidateInvalid(){
        $this->assertTrue(!Oid563::validate(Oid453::generate(time())));
    }

    public function testGenerate(){
        $time = (2 ** 40) - 1;
        $this->assertEquals(hexdec(substr(Oid563::generate($time), 0, 10)), $time);
    }

    public function testGenerateUint8(){
        $time = (2 ** 8) - 1;
        $this->assertEquals(hexdec(substr(Oid563::generate($time), 0, 10)), $time);
    }

    public function testGenerateUint16(){
        $time = (2 ** 16) - 1;
        $this->assertEquals(hexdec(substr(Oid563::generate($time), 0, 10)), $time);
    }

    public function testGenerateUint24(){
        $time = (2 ** 24) - 1;
        $this->assertEquals(hexdec(substr(Oid563::generate($time), 0, 10)), $time);
    }

    public function testGenerateUint32(){
        $time = (2 ** 32) - 1;
        $this->assertEquals(hexdec(substr(Oid563::generate($time), 0, 10)), $time);
    }

    public function testGenerateUint40(){
        $time = (2 ** 40) - 1;
        $this->assertEquals(hexdec(substr(Oid563::generate($time), 0, 10)), $time);
    }

    public function testGenerateUint48(){
        $uint40 = (2 ** 40) - 1;
        $uint48 = (2 ** 48) - 1;
        $this->assertEquals(hexdec(substr(Oid563::generate($uint48), 0, 10)), $uint40);
    }

    public function testGetId(){
        $object = Oid563::create();
        $this->assertTrue(Oid563::validate($object->getId()));
    }

    public function testGetTimestamp(){
        $time = (2 ** 40) - 1;
        $object = new Oid563(Oid563::generate($time));
        $this->assertEquals($object->getTimestamp(), $time);
    }

    public function testGetByteSize(){
        $object = Oid563::create();
        $this->assertEquals($object->getByteSize(), 14);
    }

    public function testGetCharSize(){
        $object = Oid563::create();
        $this->assertEquals($object->getCharSize(), 28);
    }

    public function testToString(){
        $object = Oid563::create();
        $this->assertEquals((string)$object, $object->getId());
    }
}