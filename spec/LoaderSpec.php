<?php
describe('Kahlan SQLite Loader', function() {
    it('resets the database', function() {
        \Brunty\Kahlan\SQLite\resetDB();

        /** @var PDO $db */
        $db = \Kahlan\box('db.sqlite');
        $stmt = $db->query('SELECT * FROM Tests');
        $things = $stmt->fetchAll();

        expect($things)->toHaveLength(0);
    });

    it('loads fixtures into the database', function() {
        \Brunty\Kahlan\SQLite\resetDB();
        \Brunty\Kahlan\SQLite\load('things');

        /** @var PDO $db */
        $db = \Kahlan\box('db.sqlite');
        $stmt = $db->query('SELECT * FROM Tests');
        $things = $stmt->fetchAll();

        expect($things)->toHaveLength(3);
    });
});
