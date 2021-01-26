<?php declare(strict_types=1);
/**
 * Copyright 2019 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace Wayang\Stdlib\Oid;

use Wayang\Stdlib\StringableInterface;

interface OidInterface extends StringableInterface
{
  /**
   * @return string
   */
  public function getId(): string;

  /**
   * @return int
   */
  public function getTimestamp(): int;
}