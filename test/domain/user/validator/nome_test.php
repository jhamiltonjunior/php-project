<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Validator\Name;


class NomeTest extends TestCase {
  public function testCreate(): void {
    // Menos de 10 caracteres
    $nome = Name::create('Nome');

    $this->assertTrue($nome->getValue());
  }
}