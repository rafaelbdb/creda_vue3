<?php

declare(strict_types=1);

namespace Api\Controller;

use Api\Model\User;

class UserController
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function list()
    {
        $list = $this->user->search();
        echo json_encode($list);
    }

    public function show($username)
    {
        $foundUser = $this->user->searchByUsername($username);
        echo json_encode($foundUser);
    }

    public function store()
    {
        $user = $this->user->create($_POST);
        echo json_encode($user);
    }

    public function update($id)
    {
        $user = $this->user->update($id, $_POST);
        echo json_encode($user);
    }

    public function destroy($id)
    {
        $user = $this->user->delete($id);
        echo json_encode($user);
    }
}
