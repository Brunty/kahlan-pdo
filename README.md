# Kahlan PDO

[![Build Status](https://travis-ci.org/Brunty/kahlan-pdo.svg?branch=master)](https://travis-ci.org/Brunty/kahlan-pdo) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/5b7b21e2-8627-4c6b-97d3-4a763023a33c/mini.png)](https://insight.sensiolabs.com/projects/5b7b21e2-8627-4c6b-97d3-4a763023a33c)

🗄 Provides functionality to work with PDO, reset a database and load fixtures within Kahlan

## Requirements

* PHP >= 7.0
* Kahlan ^3.0

## Installation

`composer require brunty/kahlan-pdo --dev`

## Setup

**Folders:**

1. Create a folder to store your database related files (`/spec/db` is suggested)
2. Create a folder to store your SQL files to load into the database (`/spec/db/sql` is suggested)
3. Within the folder where your database related files will be stored created a file `reset.php` which will be the file you'll use to reset your DB whenever you call the function to do so.
4. Within the folder where your database related files will be stored, created a `fixtures` folder
5. Create fixtures as you need for your tests in the `fixtures` folder.

**Config:**

In `kahlan-config.php` setup the path to your db folder and if you wish to use the `\Brunty\Kahlan\PDO\sql()` helper function, add the path to a directory that will hold SQL files as follows:

```php
\Kahlan\box('db.path', __DIR__ . '/spec/db');
\Kahlan\box('db.path.sql', __DIR__ . '/spec/db/sql');
```

## Usage

```php
<?php

use function Brunty\Kahlan\PDO\reset;
use function Brunty\Kahlan\PDO\fixture;
use function Brunty\Kahlan\PDO\db;

describe('SqliteThingRepository', function() {

    beforeEach(function() {
        reset(); // reset our database before each test
    });

    it('gets all things from the database', function() {
        fixture('things'); // load fixtures inside this test

        // do stuff
        $stmt = db()->query('SELECT * FROM Things');
        $things = $stmt->fetchAll();
        // run assertions
    });
});
```

Using the `\Brunty\Kahlan\PDO\reset()` function without a parameter will create an in-memory database in SQLite, but you can pass the DSN, username and password to it and it'll use those instead.

With loading fixtures, you can then create a file within `/spec/db/fixtures` and call the name of that file (without the `.php` extension) to do whatever you might need to load data into the database.

For example:

`\Brunty\Kahlan\PDO\load('things');` would load the file: `/spec/db/fixtures/things.php` into the database.

You could setup objects yourself with something like [Faker](https://github.com/fzaninotto/Faker) or you could just load SQL into the database directly:

In `/spec/db/fixtures/things.php`:
```php
<?php

\Brunty\Kahlan\PDO\sql('things');
```

The helper function `\Brunty\Kahlan\PDO\db()` returns the instance of PDO that is in the Kahlan box.

The helper function `\Brunty\Kahlan\PDO\sql()` loads SQL from the file given (in the `\Kahlan\box('db.path.sql')` directory, without the `.sql` extension) into the PDO instance in the Kahlan box.

## Contributing

This started as a small personal project.

Although this project is small, openness and inclusivity are taken seriously. To that end a code of conduct (listed in the contributing guide) has been adopted.

[Contributor Guide](CONTRIBUTING.md)
