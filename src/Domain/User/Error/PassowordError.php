<?php

namespace Domain\User\Error;

class PasswordError extends \Error {
  public function __construct (string $password) {
    $this->message = "This password $password is invalid";
  }

  public function getValue(): string {
    return $this->message;
  }
}