<?php

namespace Michalsn\CodeIgniterHtmxDemo\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedDemo extends Seeder
{
    public function run()
    {
        $this->call(SeedBooksTable::class);
        $this->call(SeedParagraphsTable::class);
    }
}
