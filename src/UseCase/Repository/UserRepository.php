<?php

namespace UseCase\Repository;

interface UserRepository {
  public function createUser(): string;
}