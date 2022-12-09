<?php

namespace Michalsn\CodeIgniterDemoHtmx\Config;

class Registrar
{
    public static function Pager(): array
    {
        return [
            'templates' => [
                'default_htmx_full' => 'Michalsn\CodeIgniterDemoHtmx\Views\Pager\default_htmx_full',
            ],
        ];
    }
}