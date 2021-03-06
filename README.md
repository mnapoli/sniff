# Sniff

Simpler PHP code sniffer, built on top of [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer).

**This project has been replaced by [Pretty](https://github.com/mnapoli/pretty)**

[![Build Status](https://img.shields.io/travis/mnapoli/sniff/master.svg?style=flat-square)](https://travis-ci.org/mnapoli/sniff)

## Why?

[PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) can validate and fix the formatting of your code.

Sniff is a command that wraps `php-cs-fixer` to make it easier to use and configure.

It boils down to a simple `.sniff.json` file and 3 commands:

```bash
$ sniff validate
```

Validates that your code complies with your coding standard. Useful in CI to run on each pull request or commit.

```bash
$ sniff diff
```

Validates that your code complies with your coding standard and outputs the diff necessary to fix the errors. Useful to review the fixes before applying them.

```bash
$ sniff fix
```

Fix your code to make it compliant with your coding standard.

## Installation


```
composer require mnapoli/sniff
```

You can then invoke the command with:

```bash
$ vendor/bin/sniff
```

You can also install it globally with Composer to be able to call it with `sniff`:

- `composer global require mnapoli/sniff`
- add the `~/.composer/bin` path to your `PATH`

## Configuration

Sniff is configured using a `.sniff.json` file:

```json
{
    "paths": [
        "src",
        "tests"
    ],
    "rules": {
        "@PSR2": true
    },
    "allow-risky": true
}
```

- `paths` (**mandatory**): list of directories or files to analyze
- `rules` (default: `@PSR2`): list of rules to enable (detailed below)
- `allow-risky` (default: no): allows you to set whether risky rules may run (a risky rule is a rule which could change the code's behaviour)

The complete list of rules is detailed in [PHP-CS-Fixer's documentation](https://github.com/FriendsOfPHP/PHP-CS-Fixer#usage).

Below is an example that enables PSR-2 + Symfony's coding standard, along with a few custom options:

```json
{
    "paths": [ ... ],
    "rules": {
        "@PSR2": true,
        "@Symfony": true,
        "array_syntax": {
            "syntax": "short"
        },
        "blank_line_before_return": false
    }
}
```

## Contributing

To run the tests:

```
$ composer tests
```

## Credits

This project is only a small wrapper above [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer), a huge thanks to the contributors of that tool.

Sniff is heavily inspired from [Coke](https://github.com/M6Web/Coke), a nice wrapper for [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer).

## License
   
Sniff is licensed under the [MIT license](LICENSE).
