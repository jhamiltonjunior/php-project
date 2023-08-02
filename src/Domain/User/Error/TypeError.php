<?php

namespace Domain\User\Error;

class TypeError {
  public NameError $name;
  public EmailError $email;
  public PasswordError $password;

  public function __construct(
    $name = new NameError(''),
    $email = new EmailError(''),
    $password = new PasswordError(''),
  ) {
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
  }
}
