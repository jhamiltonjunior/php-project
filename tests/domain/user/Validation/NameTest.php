<?php declare(strict_types=1);

use App\Domain\User\Validation;
use PHPUnit\Framework\TestCase;

use \App\Domain\User\Validation\Name;


class NameTest extends TestCase {
  public function testCreate() {
    // Menos de 10 caracteres
    $nome = Name::create('Nome');

    echo $nome->getValue();


    $this->assertTrue(true);
  }
}