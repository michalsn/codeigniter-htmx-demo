<?php

namespace Michalsn\CodeIgniterHtmxDemo\Cells\TableAdvanced;

use CodeIgniter\View\Cells\Cell;
use CodeIgniter\Pager\Pager;
use Michalsn\CodeIgniterHtmxDemo\Models\BookModel;
use InvalidArgumentException;

class TableAdvancedCell extends Cell
{
    public string $limit = '2';
    public string $page = '1';
    public string $search = '';
    public string $sortColumn = 'id';
    public string $sortDirection = 'asc';

    protected array $validSortColumns = ['id', 'title', 'author'];
    protected array $validSortDirections = ['asc', 'desc'];

    protected array $perPage = [2 => 2, 5 => 5, 10 => 10];

    protected string $baseURL = 'cells/table-advanced';

    protected array $books;
    protected Pager $pager;

    public function mount()
    {
        if (! in_array($this->sortColumn, $this->validSortColumns)) {
            throw new InvalidArgumentException('Sort column is out of the range.');
        }

        if (! in_array($this->sortDirection, $this->validSortDirections)) {
            throw new InvalidArgumentException('Sort direction is out of the range.');
        }

        if (! in_array($this->limit, array_keys($this->perPage))) {
            throw new InvalidArgumentException('Items per page is out of the range.');
        }

        helper('form');
        
        $model = model(BookModel::class);     

        $this->books = $model 
            ->when($this->search !== '', function ($query) {
                return $query
                    ->like('title', $this->search, 'both')
                    ->orLike('author', $this->search, 'both');
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate((int) $this->limit, 'default', (int) $this->page);

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

    protected function getPerPageProperty(): array
    {
        return $this->perPage;
    }

    protected function baseURL(): string
    {
        $queryString = [
            'sortColumn'    => $this->sortColumn,
            'sortDirection' => $this->sortDirection,
        ];
        
        return $this->baseURL . '?' . http_build_query($queryString); 
    }

    protected function sortByURL(string $column): string
    {
        if (! in_array($column, $this->validSortColumns)) {
            throw new InvalidArgumentException('Sort column is out of the range.');
        }

        $queryString = [
            'sortColumn'    => $column,
            'sortDirection' => $this->sortColumn === $column && $this->sortDirection === 'asc' ? 'desc' : 'asc',
        ];

        return $this->baseURL . '?' . http_build_query($queryString); 
    }

    protected function getSortIndicator(string $column): string
    {
        if (! in_array($column, $this->validSortColumns)) {
            throw new InvalidArgumentException('Sort column is out of the range.');
        }

        if ($column === $this->sortColumn) {
            return $this->sortDirection === 'asc' ? '↑' : '↓';
        }

        return '';
    }
}