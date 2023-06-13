install:
	composer install
validate:
	composer validate
update:
	composer update
lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin
lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src bin
test:
	composer exec --verbose phpunit tests -- --coverage-text
test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml
test-coverage-html:
	composer exec --verbose phpunit tests -- --coverage-html coverage
push:
	git add . 
	git commit -m 'fix'
	git push origin main