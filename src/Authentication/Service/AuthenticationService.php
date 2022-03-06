<?php
namespace Exercise\Authentication\Service;

use Exercise\Authentication\Dao\LoginTokenDao;
use Exercise\User\Model\User;

class AuthenticationService {
    public function userIsAllowedAccess(User $user, string $token): bool {
        return (new LoginTokenDao())->userHasProvidedValidToken($user, $token);
    }
}
