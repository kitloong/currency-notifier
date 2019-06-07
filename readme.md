# Currency Rate Notifier

[![CircleCI](https://circleci.com/gh/kitloong/currency-notifier.svg?style=svg)](https://circleci.com/gh/kitloong/currency-notifier)

A simple scheduler script to notify when currency rate increased/dropped to desired rate.

## Install

    composer install

## Configure pre-commit

    cp .githooks/pre-commit .git/hooks/pre-commit
    chmod +x .git/hooks/pre-commit

## Test

    ./vendor/bin/phpunit --coverage-html ./build/test-coverage
    
## Code sniffer

    ./vendor/bin/phpcs --standard=phpcs.xml --report=checkstyle --report-file=./build/checkstyle.xml
