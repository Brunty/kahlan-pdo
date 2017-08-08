<?php
use function \Brunty\Kahlan\PDO\reset;
use function \Brunty\Kahlan\PDO\db;
use function \Brunty\Kahlan\PDO\fixture;

describe('Kahlan SQLite Loader', function() {
    it('resets the database', function() {
        reset();

        $stmt = db()->query('SELECT * FROM Tests');
        $things = $stmt->fetchAll();

        expect($things)->toHaveLength(0);
    });

    it('loads fixtures into the database', function() {
        reset();
        fixture('things');

        $stmt = db()->query('SELECT * FROM Tests');
        $things = $stmt->fetchAll();

        expect($things)->toHaveLength(3);
    });
});
