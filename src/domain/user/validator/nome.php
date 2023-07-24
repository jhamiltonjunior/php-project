<?php

namespace Validator;

class Name {
  private string $name;

  private function __construct(string $name) {
    $this->name = $name;
  }

  public static function create (string $name): Name {
    $name = trim($name);
    $name = preg_replace('/( )+/', ' ', $name);

    if (!Name::validate($name)) {
    }

    return new Name($name);
  }

  public function getValue(): string {
    return $this->name;
  }

  private static function validate(string $name): bool {
    if (
      !$name ||
      strlen($name) < 10 ||
      strlen($name) > 255
    ) {
      return false;
    }
    
    return true;
  }
}

$name = Name::create('Titulo da     minha   tarefa!');

print_r($name);
print_r($name->getValue());
