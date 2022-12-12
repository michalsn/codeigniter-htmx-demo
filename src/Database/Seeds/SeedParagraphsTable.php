<?php

namespace Michalsn\CodeIgniterDemoHtmx\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Test\Fabricator;
use Michalsn\CodeIgniterDemoHtmx\Models\ParagraphModel;

class SeedParagraphsTable extends Seeder
{
    public function run()
    {
        $data = [];

        $formatters = [
            'title' => 'sentence',
            'body'  => 'paragraph',
        ];

        $fabricator = new Fabricator(ParagraphModel::class, $formatters);

        for ($i = 0; $i < 5; $i++) {
            $data[] = $fabricator->make();
            $data[$i]->sort = $i + 1;
        }

        $this->db->table('paragraphs')->insertBatch($data);
    }
}
