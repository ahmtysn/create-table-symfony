# SymphArt

> A basic Symfony CRUD application used in the tutorial series "Up & Running With Symfony"

## Quick Start

``` bash
# Install dependencies
composer install

# Edit the env file and add DB params

# Create Article schema
php bin/console doctrine:migrations:diff
# Run migrations
php bin/console doctrine:migrations:migrate

# Build for production
npm run build

# Run symfony server 
symfony server:start

```

## App Info

### Defination

It is just a demo study to understand how work symfony and how to use CRUD operations in communication with phpmyadmin. 


### Author

Ahmet Yasin

### Version

1.0.0

### License

Free study with myself