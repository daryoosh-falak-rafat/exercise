<?php
namespace Exercise\Matcher\Dao;

use Exercise\User\Model\User;

class MatcherDao {
    public function getMatches(User $user): array {
        $connection = new \mysqli('db', 'root', 'example', 'exercise', 3306);
        $sql = 'SELECT u.name, u.gender, u.age  FROM user u
                LEFT JOIN swipe s on s.profile_id = u.id
                WHERE u.id != "' . $user->getId() .'" 
                AND (s.user_id != "' . $user->getId() .'" OR s.user_id IS NULL)
                ORDER BY RAND() LIMIT 5';
        $result = $connection->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isMatch(User $user, User $profile): bool {
        $connection = new \mysqli('db', 'root', 'example', 'exercise', 3306);
        $sql = 'SELECT * FROM swipe WHERE user_id = "' . $profile->getId()
            . '" AND profile_id = "' . $user->getId()
            . '" AND positive_swipe = 1';
        $result = $connection->query($sql);
        return sizeof($result->fetch_assoc() ?? []) > 0;
    }

    public function recordSwipe(User $user, User $profile, bool $positiveSwipe): void {
        $connection = new \mysqli('db', 'root', 'example', 'exercise', 3306);
        $sql = 'INSERT INTO swipe (user_id, profile_id, positive_swipe) VALUES ('
            . '"' . $connection->escape_string($user->getId()) . '"' . ','
            . '"' . $connection->escape_string($profile->getId()) . '"' . ','
            . '"' . $connection->escape_string($positiveSwipe ? '1' : '0') . '"'
            . ')';
        $connection->query($sql);
    }
}
