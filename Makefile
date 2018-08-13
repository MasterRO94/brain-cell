default: \
	composer \
	code \
	test

build: \
	composer \
	code \
	test

# --------------------
# Utility

composer:
	composer install

code: \
	code.format.header \
	code.format.use \
	code.fix

code.format.header:
	vendor/bin/php-formatter formatter:header:fix src --ansi --config="build/code/config"

code.format.strict:
	vendor/bin/php-formatter formatter:strict:fix src --ansi --config="build/code/config"

code.format.use:
	vendor/bin/php-formatter formatter:use:sort src --ansi --config="build/code/config"

code.fix:
	vendor/bin/php-cs-fixer fix -v --ansi --config="build/code/config/.php_cs.php"

# --------------------
# Test

test:
	vendor/bin/phpunit --colors=always --columns=50 --coverage-html="build/coverage"
