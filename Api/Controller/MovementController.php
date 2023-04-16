<?php

declare(strict_types=1);

namespace Api\Controller;

use Api\Model\Movement;

class MovementController
{
    private Movement $movement;
    private string $table;

    public function __construct(string $table)
    {
        $this->table = $table;
        $this->movement = new Movement($this->table);
    }

    public function list(?string $id = null, $userId = null)
    {
        $data = [
            'id' => $id,
            'userId' => $userId
        ];

        $list = $this->movement->search($data);
        echo json_encode($list);
    }

    public function store()
    {
        $movement = $this->movement->create($_POST);
        echo json_encode($movement);
    }

    public function update($id)
    {
        $movement = $this->movement->update($id, $_POST);
        echo json_encode($movement);
    }

    public function destroy($id)
    {
        $movement = $this->movement->delete($id);
        echo json_encode($movement);
    }
}