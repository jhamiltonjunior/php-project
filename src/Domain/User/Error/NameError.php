<?php

namespace Domain\User\Error;


class NameError extends \Error {
  public function __construct (string $name) {
    $this->message = "This name $name is invalid";
  }

  public function getValue(): string {
    return $this->message;
  }
}