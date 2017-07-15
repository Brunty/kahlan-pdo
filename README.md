# Kahlan SQLite

Provides functionality to reset an SQLite database and load fixtures within the Kahlan testing framework.

## Requirements

* PHP >= 7.0
* Kahlan ^3.0
* SQLite Extension

## Installation

`composer require brunty/kahlan-sqlite --dev`

## Setup

**Folders:**

1. Create a folder to store your database related files (`/spec/db` is suggested)
2. Within the folder where your database related files will be stored created a file `reset.sql` which will be the file you'll use to reset your DB whenever you call the function to do so.
3. Within the folder where your database related files will be stored, created a `fixtures` folder (`/spec/db/fixtures` is suggested)
4. Create fixtures as you need for your tests in the `fixtures` folder.

**Config:**

In `kahlan-config.php` setup the path to your db folder as follows:

```php
\Kahlan\box('db.path', __DIR__ . '/spec/db');
```

## Usage

```php
<?php

describe('SqliteThingRepository', function() {

    beforeEach(function() {
        \Brunty\Kahlan\resetDB(); // reset our database before each test
        $this->db = \Kahlan\box('db.sqlite');
    });

    it('gets all things from the database', function() {
        \Brunty\Kahlan\load('things'); // load fixtures inside this test

        // do stuff
    });
});
```

Using the `\Brunty\Kahlan\resetDb()` function without a parameter will create an in-memory database, but if you wanted one on disk, you could easily pass the absolute path to it and it'll use that instead.

With loading fixtures, you can then create a file within `/spec/db/fixtures` and call the name of that file (without the `.sql` extension) to load that fixture into the database.

For example:

`\Brunty\Kahlan\load('things');` would load the file: `/spec/db/fixtures/things.sql` into the database.

## Contributing

This started as a small personal project.

Although this project is small, openness and inclusivity are taken seriously. To that end a code of conduct (listed in the contributing guide) has been adopted.

[Contributor Guide](CONTRIBUTING.md)
