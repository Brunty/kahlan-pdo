# Kahlan PDO

🗄 Provides functionality to work with PDO, reset a database and load fixtures within Kahlan

## Requirements

* PHP >= 7.0
* Kahlan ^3.0

## Installation

`composer require brunty/kahlan-pdo --dev`

## Setup

**Folders:**

1. Create a folder to store your database related files (`/spec/db` is suggested)
2. Within the folder where your database related files will be stored created a file `reset.php` which will be the file you'll use to reset your DB whenever you call the function to do so.
3. Within the folder where your database related files will be stored, created a `fixtures` folder
4. Create fixtures as you need for your tests in the `fixtures` folder.

**Config:**

In `kahlan-config.php` setup the path to your db folder as follows:

```php
\Kahlan\box('db.path', __DIR__ . '/spec/db');
```

## Usage

```php
<?php

use function Brunty\Kahlan\PDO\resetDB;
use function Brunty\Kahlan\PDO\loadFixture;
use function Brunty\Kahlan\PDO\db;

describe('SqliteThingRepository', function() {

    beforeEach(function() {
        resetDB(); // reset our database before each test
    });

    it('gets all things from the database', function() {
        loadFixture('things'); // load fixtures inside this test

        // do stuff
        $stmt = db()->query('SELECT * FROM Things');
        $things = $stmt->fetchAll();
        
    });
});
```

Using the `\Brunty\Kahlan\PDO\resetDb()` function without a parameter will create an in-memory database in SQLite, but you can pass the DSN to it and it'll use that instead.

With loading fixtures, you can then create a file within `/spec/db/fixtures` and call the name of that file (without the `.php` extension) to do whatever you might need to load data into the database.

For example:

`\Brunty\Kahlan\PDO\load('things');` would load the file: `/spec/db/fixtures/things.php` into the database.

You could setup objects yourself with something like [Faker](https://github.com/fzaninotto/Faker) or you could just load SQL into the database directly:

In `/spec/db/fixtures/things.php`:
```php
<?php

\Brunty\Kahlan\PDO\loadSQL(__DIR__ . '/../sql/things.sql');
```

The helper function `\Brunty\Kahlan\PDO\db()` returns the instance of PDO that is in the Kahlan box.

The helper function `\Brunty\Kahlan\PDO\loadSQL()` loads SQL from the file given into the PDO instance in the Kahlan box.

## Contributing

This started as a small personal project.

Although this project is small, openness and inclusivity are taken seriously. To that end a code of conduct (listed in the contributing guide) has been adopted.

[Contributor Guide](CONTRIBUTING.md)
