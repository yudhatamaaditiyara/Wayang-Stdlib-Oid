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
use Wayang\Exception\Spl\BadMethodCallException;

/**
 */
class AbstractOidTest extends TestCase
{
    public function testValidate(){
        try {
            AbstractOid::validate("");
            $this->assertTrue(false);
        } catch (BadMethodCallException $e) {
            $this->assertTrue(true);
        }
    }

    public function testGenerate(){
        try {
            AbstractOid::generate(0);
            $this->assertTrue(false);
        } catch (BadMethodCallException $e) {
            $this->assertTrue(true);
        }
    }
}