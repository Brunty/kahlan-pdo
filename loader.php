<?php

/**
 * Resets the database that's in the Kahlan container under the `db.sqlite` key.
 *
 * To use this, specify a file called `reset.sql` within the `/spec/db` folder of your project
 * When this function is called, it'll bind a new PDO instance into the Kahlan container under `db.sqlite`
 * It will then set that DB to whatever is in the `reset.sql` file
 *
 * @param string $db
 */
function resetDB($db = ':memory:')
{
    \Kahlan\box('db.sqlite', new PDO("sqlite:{$db}"));
    $sql = file_get_contents(\Kahlan\box('db.path') . '/reset.sql');
    \Kahlan\box('db.sqlite')->exec($sql);
}

/**
 * Loads a fixture file into the database that's in the Kahlan container under the `db.sqlite` key.
 *
 * @param string $fixture
 */
function load(string $fixture)
{
    $sql = file_get_contents(\Kahlan\box('db.path') . "/fixtures/{$fixture}.sql");
    \Kahlan\box('db.sqlite')->exec($sql);
}
