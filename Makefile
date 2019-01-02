default: build

build: \
	code \
	test

# --------------------
# Code Monitoring

code: \
	code.format.header \
	code.format.use \
	code.sniff.report

code.fix: \
	code.format.header \
	code.format.use \
	code.sniff.fix \
	code.sniff.report

code.format.header:
	vendor/bin/php-formatter formatter:header:fix src --ansi --config="build/code/config"

code.format.use:
	vendor/bin/php-formatter formatter:use:sort src --ansi --config="build/code/config"

code.sniff.report:
	vendor/bin/phpcs --report=diff --report-full src

code.sniff.report.only.full:
	vendor/bin/phpcs --report-full src

code.sniff.report.only.diff:
	vendor/bin/phpcs --report=diff src

code.sniff.fix:
	vendor/bin/phpcbf src

# --------------------
# Test

test:
	vendor/bin/phpunit --colors=always --columns=50 --coverage-html="build/coverage"
