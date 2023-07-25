# Regex


Esse código remove todo espaço indesejado, ou seja, vai remover se ouver mais de um espaço em branco 
```php
preg_replace('/( )+/', ' ', $name);
```