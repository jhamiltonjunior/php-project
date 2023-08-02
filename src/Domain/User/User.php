<?php

namespace Domain\User;

use Domain\User\Error\EmailError;
use Domain\User\Error\NameError;
use Domain\User\Error\PasswordError;
use Domain\User\Validation\Email;
use Domain\User\Validation\Name;
use Domain\User\Validation\Password;
use Domain\User\Validation\TypeUser;

class User {
  private NameError | Name $name;
  private EmailError | Email $email;
  private PasswordError | Password $password;

  private function __construct(
    Name $name,
    Email $email,
    Password $password,
  ) {
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
  }

  public static function create(
    TypeUser $user,
  ): NameError | EmailError | PasswordError | User {
    $nameOrError = Name::create($user->name);
    $emailOrError = Email::create($user->email);
    $passwordOrError = Password::create($user->password);
    
    $nameError = new NameError($user->name);
    $emailError = new EmailError($user->email);
    $passwordError = new PasswordError($user->password);

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