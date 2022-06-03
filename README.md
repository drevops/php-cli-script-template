# PHP CLI script template

PHP script template for single-file CLI scripts without dependency on external packages.

[![CircleCI](https://circleci.com/gh/drevops/php-cli-script-template/tree/main.svg?style=shield)](https://circleci.com/gh/drevops/php-cli-script-template/tree/main)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/drevops/php-cli-script-template)

## Usage

### Without tests

1. Copy `script.php` file to your project and follow instructions in the file
   to rename several strings.

### With tests

1. Copy `script.php` file to your project and follow instructions in the file
   to rename several strings.
2. Copy `test` directory to your project. Also check `composer.json` on test
   runner configuration.

## Development

To lint code (`script.php` and tests) according to [Drupal coding standards](https://www.drupal.org/docs/develop/standards/coding-standards):

    composer lint

To run tests:

    composer test

## License

[GNU GPL2](http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
