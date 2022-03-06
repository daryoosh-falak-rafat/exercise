<?php
namespace Exercise\Matcher\Dao;

use Exercise\Core\Dao\SqlDao;
use Exercise\User\Model\User;

class MatcherDao extends SqlDao {
    public function getMatches(User $user): array {
        $sql = 'SELECT u.name, u.gender, u.age  FROM user u
                LEFT JOIN swipe s on s.profile_id = u.id
                WHERE u.id != "' . $user->getId() .'" 
                AND (s.user_id != "' . $user->getId() .'" OR s.user_id IS NULL)
                ORDER BY RAND() LIMIT 5';
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isMatch(User $user, User $profile): bool {
        $sql = 'SELECT * FROM swipe WHERE user_id = "' . $profile->getId()
            . '" AND profile_id = "' . $user->getId()
            . '" AND positive_swipe = 1';
        $result = $this->db->query($sql);
        return sizeof($result->fetch_assoc() ?? []) > 0;
    }

    public function recordSwipe(User $user, User $profile, bool $positiveSwipe): void {
        $sql = 'INSERT INTO swipe (user_id, profile_id, positive_swipe) VALUES ('
            . '"' . $this->db->escape_string($user->getId()) . '"' . ','
            . '"' . $this->db->escape_string($profile->getId()) . '"' . ','
            . '"' . $this->db->escape_string($positiveSwipe ? '1' : '0') . '"'
            . ')';
        $this->db->query($sql);
    }
}
