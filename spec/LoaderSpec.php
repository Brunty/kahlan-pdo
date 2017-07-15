<?php
describe('Kahlan SQLite Loader', function() {
    it('resets the database', function() {
        \Brunty\Kahlan\resetDB();
        /** @var PDO $db */
        $db = \Kahlan\box('db.sqlite');
        $stmt = $db->query('SELECT * FROM Tests');
        $things = $stmt->fetchAll();

        expect($things)->toHaveLength(0);
    });

    it('loads fixtures into the database', function() {
        \Brunty\Kahlan\resetDB();
        \Brunty\Kahlan\load('things');

        /** @var PDO $db */
        $db = \Kahlan\box('db.sqlite');
        $stmt = $db->query('SELECT * FROM Tests');
        $things = $stmt->fetchAll();

        expect($things)->toHaveLength(3);
    });
});
