<?php
namespace Exercise\User\Dao;

use Exercise\User\Dao\Mapper\UserMapper;
use Exercise\User\Model\User;

class UserDao {
    public function getUserById(string $id): User {
        $connection = new \mysqli('db', 'root', 'example', 'exercise', 3306);
        $sql = 'SELECT * FROM user WHERE id = "' . $connection->escape_string($id) . '"';
        $result = $connection->query($sql);
        return (new UserMapper())->map($result->fetch_assoc());
    }

    public function createUser(User $user): void {
        $connection = new \mysqli('db', 'root', 'example', 'exercise', 3306);
        $sql = 'INSERT INTO user (id, email, password, name, gender, age) VALUES ('
            . '"' . $connection->escape_string($user->getId()) . '"' . ','
            . '"' . $connection->escape_string($user->getEmail()) . '"' . ','
            . '"' . '#' . '"' . ','
            . '"' . $connection->escape_string($user->getName()) . '"' . ','
            . '"' . $connection->escape_string($user->getGender()) . '"' . ','
            . '"' . $connection->escape_string($user->getAge()) . '"'
            . ')';
        $connection->query($sql);
    }
}