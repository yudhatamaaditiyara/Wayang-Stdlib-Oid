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

class Oid453Test extends TestCase
{
    public function testConstructor(){
        $id = Oid453::generate(time());
        $object = new Oid453($id);
        $this->assertEquals($object->getId(), $id);
    }

    public function testConstructorThrowInvalidArgumentException(){
        try {
            new Oid453(Oid563::generate(time()));
            $this->assertTrue(false);
        } catch (InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
    }

    public function testCreate(){
        $object = Oid453::create();
        $this->assertTrue($object instanceof OidInterface);
    }

    public function testValidate(){
        $this->assertTrue(Oid453::validate(Oid453::create()));
    }

    public function testValidateInvalid(){
        $this->assertTrue(!Oid453::validate(Oid563::generate(time())));
    }

    public function testGenerate(){
        $time = (2 ** 32) - 1;
        $this->assertEquals(hexdec(substr(Oid453::generate($time), 0, 8)), $time);
    }

    public function testGenerateUint8(){
        $time = (2 ** 8) - 1;
        $this->assertEquals(hexdec(substr(Oid453::generate($time), 0, 8)), $time);
    }

    public function testGenerateUint16(){
        $time = (2 ** 16) - 1;
        $this->assertEquals(hexdec(substr(Oid453::generate($time), 0, 8)), $time);
    }

    public function testGenerateUint24(){
        $time = (2 ** 24) - 1;
        $this->assertEquals(hexdec(substr(Oid453::generate($time), 0, 8)), $time);
    }

    public function testGenerateUint32(){
        $time = (2 ** 32) - 1;
        $this->assertEquals(hexdec(substr(Oid453::generate($time), 0, 8)), $time);
    }

    public function testGenerateUint40(){
        $uint32 = (2 ** 32) - 1;
        $uint40 = (2 ** 40) - 1;
        $this->assertEquals(hexdec(substr(Oid453::generate($uint40), 0, 8)), $uint32);
    }

    public function testGetId(){
        $object = Oid453::create();
        $this->assertTrue(Oid453::validate($object->getId()));
    }

    public function testGetTimestamp(){
        $time = (2 ** 32) - 1;
        $object = new Oid453(Oid453::generate($time));
        $this->assertEquals($object->getTimestamp(), $time);
    }

    public function testGetByteSize(){
        $object = Oid453::create();
        $this->assertEquals($object->getByteSize(), 12);
    }

    public function testGetCharSize(){
        $object = Oid453::create();
        $this->assertEquals($object->getCharSize(), 24);
    }

    public function testToString(){
        $object = Oid453::create();
        $this->assertEquals((string)$object, $object->getId());
    }
}