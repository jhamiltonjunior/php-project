<?php

namespace UseCase\Repository;

interface UserRepository {
  public function createUser(
    string $name, string $email, string $password
  ): \Error | string;

  public function findByEmail(string $email): bool;
  
}