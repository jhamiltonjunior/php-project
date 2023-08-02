<?php

require_once './vendor/autoload.php';

use Domain\User\Validation\TypeUser;
use Domain\User\Error\NameError;
use Domain\User\Error\TypeError;
use UseCase\Repository\UserRepository;
use UseCase\User\UseCase;

class A implements UserRepository {
  public function createuser($name, $email, $pass): \Error | string {
    return 'string';
  }

  public function findByEmail(string $email): bool {
    return true;
  }
}

$useCase = new UseCase(new A);

$typeError = new TypeError();

$result = $useCase->register(new TypeUser('Jose Hamitlon', 'jose@gmail.com', '12345678910'));

if (
  result::class === $typeError->name::class ||
  result::class === $typeError->email::class ||
  result::class === $typeError->password::class
) {
}

// print_r($typeError->name::class);
print_r($result->getvalue());
