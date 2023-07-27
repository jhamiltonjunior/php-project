<?php

namespace Domain\User\Error;


class EmailError extends \Error {
  public function __construct (string $params) {
    $this->message = "This email $params is invalid";
  }

  public function getValue(): string {
    return $this->message;
  }
}