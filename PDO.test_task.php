<?php
//Подключение к БД
$db = new PDO('mysql:host=localhost; dbname=for_tests', 'root');
//Название таблицы
$table = "Category_tree";

//Блок для ловли ошибок при установке соединения и создании таблицы.
try {
    $db = new PDO('mysql:host=localhost; dbname=for_tests', 'root');
    echo 'Connect to DB'. "\n";
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Обработка ошибок
    //создание таблицы
    $sql = "CREATE table $table (
 nodeId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 title VARCHAR (128) NOT NULL DEFAULT '',
 lft INT (45) NOT NULL DEFAULT 0,
 rgt INT (45) NOT NULL DEFAULT 0,
 lvl INT(45) NOT NULL DEFAULT 0,
 KEY lft (lft, rgt, lvl))";
    // Выполнение запроса к БД
    $db->exec($sql);
    print("Created $table Table.\n");
    //внесение первой записи в БД
    $sql = $db->prepare('INSERT INTO Category_tree (Title, lft, rgt, lvl)
    VALUES (\'Root\', 1, 2, 0)');
    $sql->execute();
    print 'First node was added'."\n";
} catch (PDOException $e) {
    echo $e->getMessage();
}



