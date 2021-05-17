<?php

require_once 'DbTreeExt.class.php';
require_once 'test-task.php';

$tree_params = array(
    'table' => 'Category_tree',
    'id' => 'nodeId',
    'left' => 'lft',
    'right' => 'rgt',
    'level' => 'lvl'
);

//Подключение к БД
$myDB = new PDO ('mysql:host=localhost; dbname=for_tests', 'root');
//Данные названий полей таблицы.
$myFields = [
    'table' =>'Category',
    'id' => 'nodeId',
    'title' => "title",
    'left'=> 'lft',
    'right' => 'rgt',
    'level' => 'lvl'
];
//Создание объекта класса для дальнейших манипуляций с указанием необходимых аргументов.
$myTree = new WorkWithMyNodes($myFields, $myDB);
// К сожалению, работать этот скрипт мне не удалось из-за ошибки, которая происходит при вызове метода
// родительского класса. Не исключаю, что из-за ошибок, сделанных мною при написании моего рабочего класса.
$myTree->addNode(1, ['Branch #1', 2, 3, 1]);

