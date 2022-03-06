<?php

use Exercise\Matcher\Dao\MatcherDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Exercise\User\Dao\UserDao;
use Exercise\User\Model\User;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get(
    '/swipe/user/{user-id}/profile/{profile-id}/preference/{preference}', function (
        Request $request,
        Response $response,
        $args
    ) {
    $user = (new UserDao())->getUserById($args['user-id']);
    $profile = (new UserDao())->getUserById($args['profile-id']);
    $positiveSwipe = boolval($args['profile-id']);
    (new MatcherDao())->recordSwipe($user, $profile, $positiveSwipe);
    $responseMessage = 'Thanks for swiping!';
    if ($positiveSwipe) {
        if ((new MatcherDao())->isMatch($user, $profile)) {
            $responseMessage .= ' Good news! ' . $profile->getName() . ' is also interested!';
        }
    }
    $response->getBody()->write(json_encode([
        'message' => $responseMessage
    ]));
    return $response;
});

$app->get('/profiles/{id}', function (Request $request, Response $response, $args) {
    $user = (new UserDao())->getUserById($args['id']);
    $response->getBody()->write(json_encode((new MatcherDao())->getMatches($user)));
    return $response;
});

$app->get('/user/create', function (Request $request, Response $response, $args) {
    $faker = Faker\Factory::create();
    $user = new User();
    $user->setId(bin2hex(random_bytes(20)));
    $user->setEmail($faker->email());
    $user->setName($faker->name());
    $user->setGender($faker->jobTitle());
    $user->setAge($faker->numberBetween(18, 80));
    $password = $faker->password();
    (new UserDao())->createUser($user);
    $userInformation = [
        'id' => $user->getId(),
        'email' => $user->getEmail(),
        'password' => $password,
        'name' => $user->getName(),
        'gender' => $user->getGender(),
        'age' => $user->getAge(),
    ];
    $response->getBody()->write(json_encode($userInformation));
    return $response;
});

$app->run();