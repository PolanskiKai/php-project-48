lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin tests
test:
	composer exec --verbose phpunit tests
autoload:
	composer dump-autoload
validate:
	composer validate
install:
	composer install
test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml