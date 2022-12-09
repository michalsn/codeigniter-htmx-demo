<?php

namespace Michalsn\CodeIgniterDemoHtmx;

use InvalidArgumentException;

class TableHelper
{
    protected string $baseURL;

    protected string $sortColumn;

    protected string $sortDirection;

    protected array $validSortColumns = [];

    public function __construct(string $baseURL, string $sortColumn, string $sortDirection)
    {
        $this->baseURL = $baseURL;
        $this->sortColumn = $sortColumn;
        $this->sortDirection = $sortDirection;
    }

    public function setValidSortColumns(array $data): TableHelper
    {
        $this->validSortColumns = $data;

        return $this;
    }

    public function baseURL(): string
    {
        $queryString = [
            'sortColumn'    => $this->sortColumn,
            'sortDirection' => $this->sortDirection,
        ];

        return $this->baseURL . '?' . http_build_query($queryString);
    }

    public function sortByURL(string $column): string
    {
        if ($this->validSortColumns !== [] && ! in_array($column, $this->validSortColumns)) {
            throw new InvalidArgumentException('Sort column is out of the range.');
        }

        $queryString = [
            'sortColumn'    => $column,
            'sortDirection' => $this->sortColumn === $column && $this->sortDirection === 'asc' ? 'desc' : 'asc',
        ];

        return $this->baseURL . '?' . http_build_query($queryString);
    }

    public function getSortIndicator(string $column): string
    {
        if ($this->validSortColumns !== [] && ! in_array($column, $this->validSortColumns)) {
            throw new InvalidArgumentException('Sort column is out of the range.');
        }

        if ($column === $this->sortColumn) {
            return $this->sortDirection === 'asc' ? '↑' : '↓';
        }

        return '';
    }
}