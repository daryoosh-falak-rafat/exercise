<?php
namespace Exercise\User\Dao;

use Exercise\Core\Dao\SqlDao;
use Exercise\User\Dao\Mapper\UserMapper;
use Exercise\User\Model\User;

class UserDao extends SqlDao {
    public function getUserById(string $id): User {
        $sql = 'SELECT * FROM user WHERE id = "' . $this->db->escape_string($id) . '"';
        $result = $this->db->query($sql);
        return (new UserMapper())->map($result->fetch_assoc());
    }

    public function getUserByEmail(string $email): User {
        $sql = 'SELECT * FROM user WHERE email = "' . $this->db->escape_string($email) . '"';
        $result = $this->db->query($sql);
        return (new UserMapper())->map($result->fetch_assoc());
    }

    public function createUser(User $user): void {
        $sql = 'INSERT INTO user (id, email, password, name, gender, age) VALUES ('
            . '"' . $this->db->escape_string($user->getId()) . '"' . ','
            . '"' . $this->db->escape_string($user->getEmail()) . '"' . ','
            . '"' . password_hash($user->getName(), PASSWORD_DEFAULT) . '"' . ','
            . '"' . $this->db->escape_string($user->getName()) . '"' . ','
            . '"' . $this->db->escape_string($user->getGender()) . '"' . ','
            . '"' . $this->db->escape_string($user->getAge()) . '"'
            . ')';
        $this->db->query($sql);
    }
}
