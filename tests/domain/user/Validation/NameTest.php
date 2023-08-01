<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \Domain\User\Validation\Name;
use \Domain\User\Error\NameError;


class NameTest extends TestCase {
  public function testCreateWithFewCharacters() {
    // Menos de 10 caracteres
    $nome = Name::create('Nome');

    $this->assertEquals($nome->getValue(), 'This name Nome is invalid');
  }

  public function testCreateManyCharacters() {
    $i = 0;

    $manyCharacters = '';

    for ($i; $i < 257; $i++) {
      $manyCharacters .= 'a';
    }
    
    $name = Name::create($manyCharacters);
    $nameError = new NameError($manyCharacters);

    // $this->assertTrue(true);
    $this->assertEquals($name->getValue(), $nameError->getValue());
  }

  public function testCreateNameWithNullValue() {
    $null_value = '';
    
    $name = Name::create($null_value);
    $nameError = new NameError($null_value);

    // $this->assertTrue(true);
    $this->assertEquals($name->getValue(), $nameError->getValue());
  }
}