<?php

namespace Domain\User\Validation;

use Domain\User\Error\EmailError;
use shared\is_valid_email_address;

class Email {
  private $email;

  public function __construct(string $email) {
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
    $tester = "/^[-!#$%&'*+/0-9=?A-Z^_a-z`{|}~](\.?[-!#$%&'*+/0-9=?A-Z^_a-z`{|}~])*@[a-zA-Z0-9](-*\.?[a-zA-Z0-9])*\.[a-zA-Z](-?[a-zA-Z0-9])+$/";

    if (
      !$email ||
      $email > 10 ||
      $email < 256
    ) {
      return false;
    }

    if (!is_valid_email_address($email)) {
      return false;
    }

    return true;
  }
}
