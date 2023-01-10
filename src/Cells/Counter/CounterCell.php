<?php

namespace Michalsn\CodeIgniterHtmxDemo\Cells\Counter;

use CodeIgniter\View\Cells\Cell;

class CounterCell extends Cell
{
    public $count = 0;

    /**
     * Increment
     *
     * @return void
     */
    public function increment()
    {
        $this->count++;
        return $this->render();
    }

    /**
     * Decrement
     *
     * @return void
     */
    public function decrement()
    {
        $this->count--;
        return $this->render();
    }
}

