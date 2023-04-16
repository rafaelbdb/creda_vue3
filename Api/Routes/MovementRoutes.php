<?php

declare(strict_types=1);

namespace Api\Routes;

use Api\Controller\MovementController;

class MovementRoutes
{
    private $app;
    private MovementController $movement;
    private string $table;

    public function __construct($app, string $table)
    {
        $this->app = $app;
        $this->table = $table;
        $this->movement = new MovementController($this->table);
    }

    public function routes()
    {
        $this->app->get('/movements', function ($request, $response, $args) {
            $this->movement->list();
        });

        $this->app->get('/movements/{id}', function ($request, $response, $args) {
            $this->movement->list($args['id']);
        });

        $this->app->get('/movements/user/{userId}', function ($request, $response, $args) {
            $this->movement->list(null, $args['userId']);
        });

        $this->app->post('/movements', function ($request, $response, $args) {
            $this->movement->store();
        });

        $this->app->put('/movements/{id}', function ($request, $response, $args) {
            $this->movement->update($args['id']);
        });

        $this->app->delete('/movements/{id}', function ($request, $response, $args) {
            $this->movement->destroy($args['id']);
        });
    }
}