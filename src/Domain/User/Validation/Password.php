<?php

namespace Domain\User\Validation;

use Domain\User\Error\PasswordError;

class Password {
  private string $password;

  private function __construct(string $password) {
    $this->password = $password;
  }

  public static function create(string $password): PasswordError | Password {
    $password = trim($password);
    $password = preg_replace('/( )+/', ' ', $password);

    if (!Password::validate($password)) {
      return new PasswordError($password);
    }

    return new Password($password);
  }

  public function getValue(): string {
    return $this->password;
  }

  private static function validate(string $password): bool {
    if (
      !$password ||
      $password == ' ' ||
      strlen($password) < 10 ||
      strlen($password) > 255
    ) return false;

    return true;
  }
}
