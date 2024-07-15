DOCKER_COMPOSE = docker compose --project-name medicore-assessment --file compose.yaml

.PHONY: run
## Generate the csv file with travel compensations per employee per month
run: var/.built vendor/composer/installed.json
	@$(DOCKER_COMPOSE) run php bin/console generate-csv

.PHONY: save
## Generate the csv file with travel compensations per employee per month, and save it to the filesystem
save: travel-compensation-per-month.csv

.PHONY: travel-compensation-per-month.csv
travel-compensation-per-month.csv: var/.built vendor/composer/installed.json
	@$(DOCKER_COMPOSE) run php bin/console generate-csv > $@
	@echo CSV file generated as $@

.PHONY: shell
## Opens a shell into the php container
shell: var/.built vendor/composer/installed.json
	$(DOCKER_COMPOSE) run php sh

.PHONY: test
## Runs all test and quality control tools (phpstan, phpcs, phpunit, code coverage checker, and infection
test:
	$(DOCKER_COMPOSE) run php sh -c '\
		vendor/bin/phpstan analyse -c phpstan.neon --ansi src \
		&& vendor/bin/phpcs --colors -s src \
		&& php vendor/bin/phpunit \
		&& php coverage-checker.php var/cache/test-coverage/clover.xml 100 \
		&& php -derror_reporting -ddisplay_errors=On vendor/bin/infection \
			--skip-initial-tests \
			--coverage=var/cache/test-coverage/ \
			--only-covered \
	'

.PHONY: fix
## Fix the codestyle problems that phpcs/phpcbf can fix on its own
fix:
	$(DOCKER_COMPOSE) run php sh -c 'vendor/bin/phpcbf --colors -s src'

.PHONY: clean
## Removes all files that are ignored by .gitignore, so you can start your development environment afresh. It will leave .idea/ alone, though
clean:
	git clean -fdX --exclude=\!.idea

var/.built: Dockerfile
	$(DOCKER_COMPOSE) build php
	touch $@

vendor/composer/installed.json: composer.lock
	$(DOCKER_COMPOSE) run php composer install
	touch $@ # composer install does not always update the change time of installed.json, so we touch it to make sure we don't run composer install too often

.PHONY: help
## Show this help
help:
	@awk '/^#/{c=substr($$0,3);next}c&&/^[[:alpha:]][[:alnum:]_-]+:/{print substr($$1,1,index($$1,":")),c}1{c=0}' $(MAKEFILE_LIST) | column -s: -t
