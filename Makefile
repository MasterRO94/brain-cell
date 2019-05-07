default: \
	code \
	test

# ----------------------------------------
# Continuous Integration
# ----------------------------------------
#
# 	The CI service will execute the "ci" recipe as the entry point.
#	- Try not to make changes to these recipies as they will break the build.
#	- Also it should be possible to run this on your machine to simulate the build.
#

# Entry Point.
.PHONY: ci
ci:
	php -v
	composer --version
	composer install --ansi --no-progress --no-suggest
	composer outdated --ansi --all
	composer dump-autoload --ansi --optimize

	$(MAKE) code
	$(MAKE) test

# --------------------
# Code Monitoring

.PHONY: \
	code code.fix code.format.header code.format.use code.phpstan \
	code.sniff.report code.sniff.report.only.full code.sniff.report.only.diff code.sniff.fix

code: code.format.header code.format.use code.sniff.report code.phpstan
code.fix: code.format.header code.format.use code.sniff.fix code.sniff.report code.phpstan

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

code.phpstan:
	vendor/bin/phpstan analyse

# --------------------
# Test

.PHONY: test
test:
	vendor/bin/phpunit --colors=always --columns=50 --coverage-html="build/coverage"
