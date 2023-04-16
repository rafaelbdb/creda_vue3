<?php

declare(strict_types=1);

namespace Api\Helpers;

class Aux
{
    private array|bool $env;

    public function enver(): void
    {
        $this->env = parse_ini_file('../.env');

        foreach ($this->env as $key => $value) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}
