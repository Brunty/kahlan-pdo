<?php
use function \Brunty\Kahlan\PDO\resetDB;
use function \Brunty\Kahlan\PDO\db;
use function \Brunty\Kahlan\PDO\loadFixture;

describe('Kahlan SQLite Loader', function() {
    it('resets the database', function() {
        resetDB();

        $stmt = db()->query('SELECT * FROM Tests');
        $things = $stmt->fetchAll();

        expect($things)->toHaveLength(0);
    });

    it('loads fixtures into the database', function() {
        resetDB();
        loadFixture('things');

        $stmt = db()->query('SELECT * FROM Tests');
        $things = $stmt->fetchAll();

        expect($things)->toHaveLength(3);
    });
});
