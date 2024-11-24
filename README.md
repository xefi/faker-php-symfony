# Faker PHP - Symfony bundle

This repository is a Symfony bundle that ensure compatibility and dependency injection for the [Faker package](https://github.com/xefi/faker-php).  
Please refer to the [main package](https://github.com/xefi/faker-php) or the [documentation](https://faker-php.xefi.com/) to understand it well.

# Configuration

Once the package is required, you can configure the locale to use.  
For this, simply create a `config/packages/xefi_faker.yaml` file, and fill it like this :
```
xefi_faker_symfony:
  locale: fr_FR
```

# Requirements

PHP 8.3+
Symfony 6.4.x or 7.1.x