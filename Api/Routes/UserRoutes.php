<?php

declare(strict_types=1);

namespace Api\Routes;

use Api\Model\User;

class UserRoutes
{
    private $app;
    private User $user;

    public function __construct($app)
    {
        $this->app = $app;
        $this->user = new User();
    }

    public function routes()
    {
        $this->app->get('/users', function ($request, $response, $args) {
            $list = $this->user->search();
            echo json_encode($list);
            echo 'list';
        });

        $this->app->get('/users/{username}', function ($request, $response, $args) {
            $foundUser = $this->user->searchByUsername($args['username']);
            echo json_encode($foundUser);
            echo 'show';
        });

        $this->app->post('/users', function ($request, $response, $args) {
            $user = $this->user->create($_POST);
            echo json_encode($user);
            echo 'store';
        });

        $this->app->put('/users/{id}', function ($request, $response, $args) {
            $user = $this->user->update($args['id'], $_POST);
            echo json_encode($user);
            echo 'update';
        });

        $this->app->delete('/users/{id}', function ($request, $response, $args) {
            $user = $this->user->delete($args['id']);
            echo json_encode($user);
            echo 'destroy';
        });
    }
}