<?php

$db = new PDO('mysql:host=localhost; dbname=for_tests', 'root');
$table = "PDOPractice";

try {
    $db = new PDO('mysql:host=localhost; dbname=for_tests', 'root');
    echo 'Connect to DB'. "\n";
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Error Handling
    $sql = "CREATE table $table(
        id INT NOT NULL AUTO_INCREMENT,
        first_name VARCHAR(45) NOT NULL,
        last_name VARCHAR(45) NOT NULL,
        email VARCHAR(45) NOT NULL,
        company_name VARCHAR(45) NOT NULL,
        is_active INT(11) NULL DEFAULT 0,
        age INT(11) NULL,
        PRIMARY KEY (id))";
    $db->exec($sql);
    print("Created $table Table.\n");
    $sql = 'INSERT INTO PDOPractice (first_name, last_name, email, company_name, is_active, age) '
        .'VALUES (\'Thom\', \'Vial\', \'thom.v@some.com\', \'Comfy\', 1, 25)';
    $db->exec($sql);
    print("New user was added \n");
} catch (PDOException $e) {
    echo $e->getMessage();
}


