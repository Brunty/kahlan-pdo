<?php

namespace Brunty\Kahlan\PDO;

use function \Kahlan\box;

/**
 * Resets the database that's in the Kahlan container under the `db.pdo` key.
 *
 * To use this, specify a file called `reset.php` within the `/spec/db` folder of your project
 * When this function is called, it'll bind a new PDO instance into the Kahlan container under `db.pdo`
 * It will then run whatever is in the `reset.php` file
 *
 * @param string $dsn
 * @param string $username
 * @param string $password
 */
function reset(string $dsn = 'sqlite::memory:', string $username = null, string $password = null)
{
    box('db.pdo', new \PDO($dsn, $username, $password));

    include rtrim(box('db.path'), '/') . '/reset.php';
}

/**
 * Loads a fixture file into the database that's in the Kahlan container under the `db.pdo` key.
 *
 * @param string $fixture
 */
function fixture(string $fixture)
{
    include rtrim(box('db.path'), '/') . "/fixtures/{$fixture}.php";
}

/**
 * Gets the instance of PDO that's in the Kahlan box
 *
 * @return \PDO
 */
function db(): \PDO
{
    return box('db.pdo');
}

/**
 * Loads SQL from the file given into the PDO instance in the Kahlan box
 *
 * @param string $filename
 */
function sql(string $filename)
{
    db()->exec(file_get_contents(rtrim(box('db.path.sql'), '/') . "/$filename.sql"));
}
