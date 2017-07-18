<?php

namespace Brunty\Kahlan\PDO;

/**
 * Resets the database that's in the Kahlan container under the `db.pdo` key.
 *
 * To use this, specify a file called `reset.sql` within the `/spec/db` folder of your project
 * When this function is called, it'll bind a new PDO instance into the Kahlan container under `db.pdo`
 * It will then set that DB to whatever is in the `reset.sql` file
 *
 * @param string $db
 */
function resetDB($db = 'sqlite::memory:')
{
    \Kahlan\box('db.pdo', new \PDO($db));

    include \Kahlan\box('db.path') . '/reset.php';
}

/**
 * Loads a fixture file into the database that's in the Kahlan container under the `db.pdo` key.
 *
 * @param string $fixture
 */
function loadFixture(string $fixture)
{
    include \Kahlan\box('db.path') . "/fixtures/{$fixture}.php";
}

/**
 * Gets the instance of PDO that is in the Kahlan box
 *
 * @return \PDO
 */
function db(): \PDO
{
    return \Kahlan\box('db.pdo');
}

/**
 * Loads SQL from the file given into the PDO instance in the Kahlan box
 *
 * @param string $filename
 */
function loadSQL(string $filename)
{
    \Brunty\Kahlan\PDO\db()->exec(file_get_contents($filename));
}