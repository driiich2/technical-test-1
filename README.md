# Technical test

## Requirements
- PHP 7.4+
## Getting started
Run following commands :
```
composer install
cd public
php -S localhost:8000
```
## Test the application
### Test API with Postman for example

- POST localhost:8000/api/convert
- Use the given json file in Body : `tests/examples/boardingCardList.json`

### Execute unit tests

- run `vendor/bin/phpunit tests`



