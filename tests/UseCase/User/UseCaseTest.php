<?php

// require_once './vendor/autoload.php';

use Domain\User\Error\NameError;
use Domain\User\Error\EmailError;
use Domain\User\Error\PasswordError;
use Domain\User\Validation\TypeUser;
use PHPUnit\Framework\TestCase;
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

class UseCaseTest extends TestCase {
  public function testRegisterUserWithInvalidName() {
    $useCase = new UseCase(new A);

    $result = $useCase->register(
      new TypeUser(
        $name = 'Jose',
        'hamilton@gmail.com',
        '12345678901234567',
      )
    );

    $userError = new NameError($name);

    $this->assertEquals($result->getValue(), $userError->getValue());
  }

  public function testRegisterUserWithInvalidEmail() {
    $useCase = new UseCase(new A);

    $result = $useCase->register(
      new TypeUser(
        'Jose Hamitlon',
        $email = 'jose@hamilton@gmail.com',
        '123454677'
      )
    );

    $userError = new EmailError($email);

    $this->assertEquals($result->getValue(), $userError->getValue());
  }
  
  public function testRegisterUserWithInvalidPassword() {
    $useCase = new UseCase(new A);

    $result = $useCase->register(
      new TypeUser(
        'Jose Hamilton',
        'hamilton@gmail.com',
        $password = '123456',
      )
    );

    $userError = new PasswordError($password);


    $this->assertEquals($result->getValue(), $userError->getValue());
  }

  public function testRegisterUserWithCorrectDatas() {
    $useCase = new UseCase(new A);

    $result = $useCase->register(
      new TypeUser(
        $name = 'Jose Hamilton',
        $email = 'hamilton@gmail.com',
        $pass = '12345678910',
      )
    );


    $this->assertEquals(
      [
        $result->getName()->getValue(),
        $result->getEmail()->getValue(),
        $result->getPassword()->getValue(),
      ],
      [$name , $email, $pass]
    );
  }
}
