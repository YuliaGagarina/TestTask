<?php

class WorkWithDB
{
    public $table = "PDOPractice";

    public function showAllUsers()
    {
        try {
            $db = new PDO('mysql:host=localhost; dbname=for_tests', 'root');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $db->prepare('SELECT * FROM PDOPractice');
            $sql->execute();
            $data = $sql->fetchALL(PDO::FETCH_ASSOC);
            echo 'All of the users are: ' . "\n";
            print_r($data);
        } catch (PDOException $err) {
            echo 'Error. Impossible to show users: ' . $err->getMessage();
        }
    }

    public function deleteUser($id)
    {
        try {
            $db = new PDO('mysql:host=localhost; dbname=for_tests', 'root');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $db->prepare('DELETE from PDOPractice WHERE id =' . "$id");
            $sql->execute();
            echo "User id $id has been deleted" . "\n";
        } catch (PDOException $err) {
            echo 'Error. Impossible to delete user: ' . $err->getMessage();
        }
    }

    public function changeUserName($id, $param, $newValue)
    {
        try {
            $db = new PDO('mysql:host=localhost; dbname=for_tests', 'root');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $db->prepare('UPDATE PDOPractice SET '.$param.' = \''.$newValue.'\' WHERE id = '.$id);
            $sql->execute();
            echo 'User data was changed. New data is '."$newValue \n";
        } catch (PDOException $err) {
            echo "Error. Impossible to change data: " . $err->getMessage();
        }
    }

    public function addNewUser(array $param)
    {
        try {
            $db = new PDO('mysql:host=localhost; dbname=for_tests', 'root');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $db->prepare('INSERT INTO PDOPractice (first_name, last_name, email, company_name, '
               .'is_active, age) VALUES (\''.$param["first_name"].'\', \''.$param["last_name"].'\', \''
               .$param["email"].'\', \''.$param['company_name'].'\', '.$param['is_active'].', '
               .$param['age'].')');

            $sql->execute();
            $sql = $db->prepare('SELECT id FROM PDOPractice WHERE first_name = \''.$param['first_name']
                .'\' AND last_name = \''.$param['last_name'].'\'');
            $sql->execute();
            $data['id'] = $sql->fetch(PDO::FETCH_ASSOC);
            echo "User was added. \n";
            print_r($data['id']);
        } catch (PDOException $err) {
            echo "Error. Impossible to add urer: " . $err->getMessage();
        }
    }
}

echo WorkWithDB::changeUserName(1, 'first_name', 'Rick');
