<?php

namespace Domain\User\Validation;

use Domain\User\Error\NameError;

class Name {
  private string $name;

  public function __construct(string $name) {
    $this->name = $name;
  }

  public static function create(string $name): NameError|Name {
    $name = trim($name);
    $name = preg_replace('/( )+/', ' ', $name);

    if (!Name::validate($name)) {
      return new NameError($name);
    }

    return new Name($name);
  }

  public function getValue(): string {
    return $this->name;
  }

  private static function validate(string $name): bool {
    if (
      !$name ||
      strlen($name) < 10 ||
      strlen($name) > 255
    ) {
      return false;
    }

    return true;
  }
}
