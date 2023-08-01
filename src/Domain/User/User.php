<?php

namespace Domain\User;

use Domain\User\Error\EmailError;
use Domain\User\Error\NameError;
use Domain\User\Error\PasswordError;
use Domain\User\Validation\Email;
use Domain\User\Validation\Name;
use Domain\User\Validation\Password;

class User {
  private NameError | Name $name;
  private EmailError | Email $email;
  private PasswordError | Password $password;

  private function __construct(
    Name $name,
    Email $email,
    Password $password,
  ) {
    $this->name = $name->getValue();
    $this->email = $email->getValue();
    $this->password = $password->getValue();
  }

  public static function create(
    string $name,
    string $email,
    string $password,
  ): NameError | EmailError | PasswordError | User {
    $nameOrError = Name::create($name);
    $emailOrError = Email::create($email);
    $passwordOrError = Password::create($password);
    
    $nameError = new NameError($name);
    $emailError = new EmailError($email);
    $passwordError = new PasswordError($password);

    if ($nameOrError::class == $nameError::class) {
      return $nameError;
    }

    if ($emailOrError::class == $emailError::class) {
      return $emailError;
    }

    if ($passwordOrError::class == $passwordError::class) {
      return $passwordError;
    }

    return new User($nameOrError, $emailOrError, $passwordOrError);
  }
}