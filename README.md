# Assessment July 2024

This application was built for an assessment assignment in July 2024. It is not meant for any other use
and is not licensed to you, whoever you are reading this :-).

## Usage

The application come with a handy `Makefile`. It tells you what you can do:

```bash
$ make help
run      Generate the csv file with travel compensations per employee per month
save     Generate the csv file with travel compensations per employee per month, and save it to the filesystem
shell    Opens a shell into the php container
test     Runs all test and quality control tools (phpstan, phpcs, phpunit, code coverage checker, and infection
fix      Fix the codestyle problems that phpcs/phpcbf can fix on its own
clean    Removes all files that are ignored by .gitignore, so you can start your development environment afresh. It will leave .idea/ alone, though
help     Show this help
```

So to generate the csv and show it on the command line, run
```bash
$ make run
```

And to generate the csv file on your filesystem, run
```bash
$ make save
```

When you're in the php container (for example, using `make shell`), you can run the application or any
quality control tool directly as well:

```bash
$ make shell
> bin/console generate-csv
[...]
> vendor/bin/phpunit
[...]
```

### Under the hood

Under the hood, this application runs as a Symfony application using symfony/console. The entrypoint for
the console command (after `bin/console`) is the `App\Edges\Cli\GenerateCsvCliCommand` class under `src/`.
From there, the Application layer (`src/Application`) is invoked, that in turn uses the Domain layer
(`src/Domain`) and/or its specific implementations in the Infrastructure layer (`src/Infrastructure`).

As is to be expected, this application isn't fitted with a variable data model or database. The data is
just hardcoded into the `App\Infrastructure\InMemoryEmployees` class. However, this class is an
implementation of an interface (`App\Domain\Employees`) and can be easily swapped out for other
implementations (a database or an input file provided by the invoker of the console command comes to
mind).


## Some notes

1. I have chosen to set up a Symfony application to show how I would build a larger application. For
the size of this application, I would normally have opted to just use symfony/console without the rest
of the framework but that wouldn't have been representative of "normal"/larger applications.
2. I have made some assumptions which I would normally have discussed with a domain expert. Some of these
questions are listed below.


## Assumptions

- An employee will, within one year, always use the same mode of transportation.
- An employee will not have holidays or days off and work 52 weeks a year.
- An employee will not move.
- An employee will be paid for the actual number of work days in a month, not for the average over
12 months.
- The 5 to 10 km limit for bike compensation is calculated for the return journey instead of the one way
journey.
- I would have questioned the sentence "However, for distances over 10 km employees prefer a different
way of commuting": does this mean they get compensation along the lines of other transportation modes, or
even something completely different? There are multiple employees that cross the 10 km per day mark and
the application is built to disregard the comment mentioned above. A next iteration could fine-tune this.
