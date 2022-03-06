<?php
namespace Exercise\User\Dao\Mapper;

use Exercise\User\Model\User;

class UserMapper {
    public function map(array $queryResult): User {
        $user = new User();
        $user->setId($queryResult['id']);
        $user->setAge($queryResult['age']);
        $user->setGender($queryResult['gender']);
        $user->setEmail($queryResult['email']);
        $user->setName($queryResult['name']);
        $user->setPassword($queryResult['password']);
        return $user;
    }
}