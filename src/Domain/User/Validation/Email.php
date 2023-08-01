<?php

namespace Domain\User\Validation;

use Domain\User\Error\EmailError;

use shared\IsValidEmail;

class Email {
  private $email;

  private function __construct(string $email) {
    $this->email = $email;
  }

  public function getValue(): string {
    return $this->email;
  }

  public static function create(string $email): EmailError|Email {
    $email = trim($email);
    $email = preg_replace('/( )+/', ' ', $email);

    if (!Email::validate($email)) {
      return new EmailError($email);
    }

    return new Email($email);
  }

  private static function validate(string $email): bool {
    // this is if is redundant
    if (
      !$email ||
      strlen($email) < 5 || 
      strlen($email) > 254
    ) {
      return false;
    }

    $isValidEmail = new IsValidEmail($email);

    if (!$isValidEmail->getValue()) {
      return false;
    }

    return true;
  }
}
