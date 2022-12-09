<?php

namespace Michalsn\CodeIgniterHtmxDemo\Config;

class Registrar
{
    public static function Pager(): array
    {
        return [
            'templates' => [
                'default_htmx_full' => 'Michalsn\CodeIgniterHtmxDemo\Views\Pager\default_htmx_full',
            ],
        ];
    }
}