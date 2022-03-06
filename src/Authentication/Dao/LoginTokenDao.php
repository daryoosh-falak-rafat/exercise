<?php
namespace Exercise\Authentication\Dao;

use Exercise\User\Model\User;

class LoginTokenDao {
    public function addToken(User $user, string $token): void {
        $connection = new \mysqli('db', 'root', 'example', 'exercise', 3306);
        $sql = 'INSERT INTO login_token (user_id, token) VALUES ('
            . '"' . $connection->escape_string($user->getId()) . '",'
            . '"' . $connection->escape_string($token) . '"'
            . ')';
        $connection->query($sql);
    }

    public function userHasProvidedValidToken(User $user, string $token): string {
        $connection = new \mysqli('db', 'root', 'example', 'exercise', 3306);
        $sql = 'SELECT * FROM login_token
                WHERE user_id = "' . $connection->escape_string($user->getId()) . '"
                AND token =  "' . $connection->escape_string($token) . '"';
        $result = $connection->query($sql);
        return sizeof($result->fetch_assoc() ?? []) > 0;
    }
}
