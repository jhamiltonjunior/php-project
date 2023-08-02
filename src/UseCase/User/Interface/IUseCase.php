<?php

namespace UseCase\User\Interface;


use Domain\User\Validation\TypeUser;

interface IUseCase {
  public function register(TypeUser $user);
}