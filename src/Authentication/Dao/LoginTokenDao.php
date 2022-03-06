<?php
namespace Exercise\Authentication\Dao;

use Exercise\Core\Dao\SqlDao;
use Exercise\User\Model\User;

class LoginTokenDao extends SqlDao {
    public function addToken(User $user, string $token): void {
        $sql = 'INSERT INTO login_token (user_id, token) VALUES ('
            . '"' . $this->db->escape_string($user->getId()) . '",'
            . '"' . $this->db->escape_string($token) . '"'
            . ')';
        $this->db->query($sql);
    }

    public function userHasProvidedValidToken(User $user, string $token): string {
        $sql = 'SELECT * FROM login_token
                WHERE user_id = "' . $this->db->escape_string($user->getId()) . '"
                AND token =  "' . $this->db->escape_string($token) . '"';
        $result = $this->db->query($sql);
        return sizeof($result->fetch_assoc() ?? []) > 0;
    }
}
