<?php

use PHPUnit\Framework\TestCase;

use \Domain\User\Validation\Email;
use \Domain\User\Error\EmailError;

class EmailTest extends TestCase {
  public function testCreateWithFewCharacters() {
    $prefix = 'email';

    // Menos de 10 caracteres
    $email = Email::create($prefix);


    // $this->assertTrue(true);
    $this->assertEquals($email->getValue(), "This email $prefix is invalid");
  }

  public function testCreateWithInvalidEmail() {
    
    $email = Email::create('jose@hamilton@gmail.com');
    // $emailError = new EmailError($manyCharacters);

    $this->assertEquals($email->getValue(), 'This email jose@hamilton@gmail.com is invalid');
  }

  public function testCreateWithManyValidEmails() {
    
    $email = Email::create('jose@gmail.com');

    $this->assertEquals($email->getValue(), 'jose@gmail.com');

    $email = Email::create('jose123@gmail.com');

    $this->assertEquals($email->getValue(), 'jose123@gmail.com');

    $email = Email::create('12345@gmail.com');

    $this->assertEquals($email->getValue(), '12345@gmail.com');

    $email = Email::create('jose123_jose@gmail.com');

    $this->assertEquals($email->getValue(), 'jose123_jose@gmail.com');

    $email = Email::create('123_jose123_@hotmail.com');

    $this->assertEquals($email->getValue(), '123_jose123_@hotmail.com');

    $email = Email::create('123_jose123_@hotmail.com');

    $this->assertEquals($email->getValue(), '123_jose123_@hotmail.com');
  }
}