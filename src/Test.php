<?php

require_once './vendor/autoload.php';

use Domain\User\Validation\TypeUser;
use Domain\User\Error\NameError;
use Domain\User\Error\TypeError;
use UseCase\Repository\UserRepository;
use UseCase\User\UseCase;

class A implements UserRepository {
  public function createuser(): string {
    return 'string';
  }
}

$useCase = new UseCase(new A);

$typeError = new TypeError();

$result = $useCase->register(new TypeUser('Jose Hamitlon', 'jose@gmail.com', '123456789'));

if (
  result::class === $typeError->name::class ||
  result::class === $typeError->email::class ||
  result::class === $typeError->password::class
) {

}

print_r($typeError->name::class);