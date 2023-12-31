<?php

namespace UseCase\User;

use Domain\User\Validation\Name;
use Domain\User\Validation\Email;
use Domain\User\Validation\Password;

use Domain\User\Error\EmailError;
use Domain\User\Error\NameError;
use Domain\User\Error\PasswordError;

use Domain\User\User;
use Domain\User\Validation\TypeUser;
use UseCase\User\Interface\IUseCase;

use UseCase\Repository\UserRepository;

class UseCase implements IUseCase {
  private UserRepository $userRepository;

  private NameError $nameError;
  private EmailError $emailError;
  private PasswordError $passwordError;
    

  public function __construct(
    UserRepository $userRepository,
  ) {
    $this->userRepository = $userRepository;

    $this->nameError = new NameError('');
    $this->emailError = new EmailError('');
    $this->passwordError = new PasswordError('');
  }

  public function register(TypeUser $typeUser) {
    $user = User::create($typeUser);

    if ($user::class == $this->nameError::class) {
      return new NameError($typeUser->name);
    }

    if ($user::class == $this->emailError::class) {
      return new EmailError($typeUser->email);
    }

    if ($user::class == $this->passwordError::class) {
      return new PasswordError($typeUser->password);
    }

    $exists = $this->userRepository->findByEmail($user->getEmail()->getValue());

    if (!$exists) {
      $dataOrError = $this->userRepository->createUser(
        $user->getName()->getValue(),
        $user->getEmail()->getValue(),
        $user->getPassword()->getValue(),
      );
  
      if($dataOrError::class === \Error::class) {
        print_r($dataOrError);
      }
    }

    return $user;
  }
}

// $name = Name::create('ddddddddddd');
// $e = Email::create('ddddddddddd');
// $p = Password::create('');

// $user = new User($name, $e, $p);

// print_r($user);
print_r('$e');