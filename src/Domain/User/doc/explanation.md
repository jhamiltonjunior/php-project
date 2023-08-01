# Regex


Esse código remove todo espaço indesejado, ou seja, vai remover se ouver mais de um espaço em branco e substituir por um espaço em branco
```php
preg_replace('/( )+/', ' ', $name);
```

# class User

No retorno do metodo create só irá instanciar a class User se passar pelos if's

```php
[...]

    if ($passwordOrError::class == $passwordError::class) {
      return $passwordError;
    }

    return new User($nameOrError, $emailOrError, $passwordOrError);
  }
[...]
```