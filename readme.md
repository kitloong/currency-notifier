# Install

    composer install

# Configure pre-commit

    cp .githooks/pre-commit .git/hooks/pre-commit
    chmod +x .git/hooks/pre-commit

# Test

    ./vendor/bin/phpunit --coverage-html ./build/test-coverage
    
# Code sniffer

    ./vendor/bin/phpcs --standard=phpcs.xml --report=checkstyle --report-file=./build/checkstyle.xml
