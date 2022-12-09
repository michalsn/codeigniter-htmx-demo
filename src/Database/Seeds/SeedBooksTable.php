<?php

namespace Michalsn\CodeIgniterHtmxDemo\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedBooksTable extends Seeder
{
    public function run()
    {
        $data = [
            ['title' => 'In Search of Lost Time', 'author' => 'Marcel Proust'],
            ['title' => 'Ulysses', 'author' => 'James Joyce'],
            ['title' => 'Don Quixote', 'author' => 'Miguel de Cervantes'],
            ['title' => 'One Hundred Years of Solitude', 'author' => 'Gabriel Garcia Marquez'],
            ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald'],
            ['title' => 'Moby Dick', 'author' => 'Herman Melville'],
            ['title' => 'War and Peace', 'author' => 'Leo Tolstoy'],
            ['title' => 'Hamlet', 'author' => 'William Shakespeare'],
            ['title' => 'The Odyssey ', 'author' => 'Homer'],
            ['title' => 'Madame Bovary', 'author' => 'Gustave Flaubert'],
            ['title' => 'Winnie-the-Pooh', 'author' => 'A.A. Milne'],
        ];

        $this->db->table('books')->insertBatch($data);
    }
}
