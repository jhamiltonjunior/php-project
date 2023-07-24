<?php

class Title {
  private string $title;

  public function __construct(string $title) {
    $this->title = $title;
  }

  public static function create (string $title): Title {
    $title = trim($title);
    $title = preg_replace('/( )+/', ' ', $title);

    if (!Title::validate($title)) {
    }

    return new Title($title);
  }

  public function getValue(): string {
    return $this->title;
  }

  private static function validate(string $title): bool {
    if (
      !$title ||
      strlen($title) < 10 ||
      strlen($title) > 255
    ) {
      return false;
    }
    
    return true;
  }
}

$title = Title::create('Titulo da     minha   tarefa!');

print_r($title);
print_r($title->getValue());
