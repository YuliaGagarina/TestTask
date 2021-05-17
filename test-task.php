<?php

require_once "DbTree.class.php";

class WorkWithMyNodes extends DbTree
{
    //защищенное свойство. подключение к БД
    protected $db;
    //открытое свойство - таблица в БД
    public $table = '';

    //Id записи
    public $tableId = '';
    //Id левой ячейки узла
    public $tableLeft = '';
    // Id правой ячейки узла
    public $tableRight = '';
    // Уровень, на котором находится узел
    public $tableLevel = '';
    // Текстовое название узла
    public $tableTitle = '';

    public function __construct($fields, $db, $lang = 'en') //Конструктор
    {
        //Присвоение значения свойству, которое подключает БД
        $this->db = $db;

        //использование родительского конструктора. Аргументы: поля таблицы, подключение к БД, язык
        parent::__construct($fields, $db, $lang);
        //присвоение значения полю Title
        $this->tableTitle = isset ($fields['title']) ? $fields['title'] : 'title';
    }

    /**
     * Transforms array with conditions to SQL query
     * Array structure:
     * array('and' => array('id = 0', 'id2 >= 3'), 'or' => array('sec = \'www\'', 'sec2 <> \'erere\'')), etc
     * where array key - condition (AND, OR, etc), value - condition string.
     *
     * @param array $condition
     * @param string $prefix
     * @param bool $where - true - yes, false (dafault) - not
     * @return string
     */
    /**
     * Этот метод подготавливает запрос к БД из названий таблицы и ее полей. использует родительский метод
     */
    protected function PrepareCondition($condition, $where = false, $prefix = '')
    {
        parent::PrepareCondotion($condition, $where = false, $prefix = '');
    }

    /**
     * Converts array of selected fields into part of SELECT query.
     *
     * @param string|array $fields Fields to be selected
     * @param string $table - Table or alias to select form
     * @return string - Part of SELECT query
     */
    /**
     * Этот метод подготавливает поля таблицы к запросу к БД. использует родительский метод
     */
    protected function PrepareSelectFields($fields = '*', $table = null)
    {
        parent::PrepareSelectFields($fields = '*', $table = null);
    }

    /**
     * Receive all data for node with number $nodeId.
     *
     * @param int $nodeId Unique node id
     * @param string|array $fields Fields to be selected
     * @return array All node data
     * @throws USER_Exception
     */
    /**
     * Этот метод получает всю информацию об узле по Id узла. Возвращает результат. Использует родительский метод
     */
    public function getNode ($nodeId, $fields = '*')
    {
        parent::getNode($nodeId, $fields = '*');
    }

    /**
     * Add new child element to node with number $parentId.
     *
     * @param int $parentId Id of a parental element
     * @param array $data Contains parameters for additional fields of a tree (if is): 'filed name' => 'importance'
     * @param string|array $condition array key - condition (AND, OR, etc), value - condition string
     * @return int Inserted element id
     */
    /**
     * Добавляет узел, используя $parentId. Выводит на печать Id  добавленного узла. Использует родительский метод
     */

    public function addNode($parentId, $data = array(), $condition = '')
    {
        /**Функции

        Добавление узла, по-умолчанию, в новое дерево. Параметры:
        - title - обязательный
        - id - узла к которому прикреплять
        Выводить id добавленного узла.
         */

        $node_id = parent::Insert($parentId, $data = array(), $condition = '');
        echo "New node was added";
        print_r($node_id);
    }

    /**
     * Deletes element with number $nodeId from the tree without deleting it's children
     * All it's children will move up one level.
     *
     * @param integer $nodeId Node id
     * @param string|array $condition array key - condition (AND, OR, etc), value - condition string
     * @return bool true if successful, false otherwise.
     */
    public function deleteNode($nodeId, $condition = '')
    {
        /**Функции

        Удаление узла. Параметры:
        - id - обязательный
         */
        /**
         * Удаляет узел, используя Id. Использует родительский метод
         * изначально проверяет, существует ли такой узел, и если существует, удаляет его.
         */

        if (!isset($nodeId)) {
            echo "Error. Node with id $nodeId is not found.";
        } else {
            parent::Delete($nodeId, $condition = '');
            echo "Node with $nodeId was deleted";
        }
    }

    /**
     * Change position of nodes. Nodes have to have same parent and same level of nesting.
     *
     * @param integer $nodeId1 first node id
     * @param integer $nodeId2 second node id
     * @return bool true if successful, false otherwise.
     */
    public function changeNodePosition($nodeId1, $nodeId2)
    {
        /**Функции

        Перемещение узла влевоб вправо. Вверх, вниз функции не нашла. Параметры:
    - id - обязательный
         */
        /**
         * Меняет дочерние узлы с использованием Id. Использует родительский метод
         * сообщает после проверки о результате
         */

        $result = parent::ChangePosition($nodeId1, $nodeId2);

        if ($result) {
            echo "Node #{$nodeId1} successfully changed position for #{$nodeId2}!";
        } else{
            echo "Impossible to change position!";
        }
    }
}
