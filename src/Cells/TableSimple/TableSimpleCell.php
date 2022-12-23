<?php

namespace Michalsn\CodeIgniterDemoHtmx\Cells\TableSimple;

use CodeIgniter\View\Cells\Cell;
use CodeIgniter\Pager\Pager;
use Michalsn\CodeIgniterDemoHtmx\Models\BookModel;

class TableSimpleCell extends Cell
{
    public int $page = 1;

    protected string $baseURL = 'cells/table-simple';

    protected array $books;
    protected Pager $pager;

    public function mount()
    {
        helper('form');
        
        $model = model(BookModel::class);     

        $this->books = $model
            ->paginate(2, 'default', $this->page);

        $this->pager = $model->pager->setPath($this->baseURL);
    }

    protected function getBooksProperty(): array
    {
        return $this->books;
    }

    protected function getPagerProperty(): Pager
    {
        return $this->pager;
    }
}