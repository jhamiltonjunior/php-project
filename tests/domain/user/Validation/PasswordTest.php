<?php

use PHPUnit\Framework\TestCase;

use \Domain\User\Validation\Password;
use \Domain\User\Error\PasswordError;

class PasswordTest extends TestCase {
  public function testCreateWithNullString(): void {
    $string = 's';

    $password = Password::create($string);

    $this->assertEquals($password->getValue(), "This password $string is invalid");
  }

  public function testCreateWithManyCharacters(): void {
    $string = '';

    for ($i = 0; $i < 256; $i++) {
      $string .= 'c';
    }

    $password = Password::create($string);
    $passwordError = new PasswordError($string);

    $this->assertEquals($password->getValue(), $passwordError->getValue());
  }
}