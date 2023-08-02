<?php

use PHPUnit\Framework\TestCase;


use Domain\User\Error\NameError;
use Domain\User\Error\EmailError;
use Domain\User\Error\PasswordError;

use Domain\User\User;
use Domain\User\Validation\TypeUser;

// use Domain\User\Validation\Email;
// use Domain\User\Validation\Password;
// echo $email::class === $emailError::class;


class UserTest extends TestCase {
  // echo $email::class === $emailError::class;

  public function testCreateWithInvalidName() {
    $user = User::create(
      new TypeUser(
        $name = 'Jose',
        'hamilton@gmail.com',
        '12345678901234567',
      )
    );

    $userError = new NameError($name);

    $this->assertEquals($user->getValue(), $userError->getValue());
  }

  public function testCreateWithInvalidEmail() {
    $user = User::create(
      new TypeUser(
        'Jose Hamitlon',
        $email = 'jose@hamilton@gmail.com',
        '123454677'
      )
    );

    $userError = new EmailError($email);

    $this->assertEquals($user->getValue(), $userError->getValue());
  }

  public function testCreateWithInvalidPassword() {
    $user = User::create(
      new TypeUser(
        'Jose Hamilton',
        'hamilton@gmail.com',
        $password = '123456',
      )
    );

    $userError = new PasswordError($password);


    $this->assertEquals($user->getValue(), $userError->getValue());
  }
}
