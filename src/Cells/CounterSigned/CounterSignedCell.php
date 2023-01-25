<?php

namespace Michalsn\CodeIgniterHtmxDemo\Cells\Counter;

use CodeIgniter\View\Cells\Cell;
use Michalsn\CodeIgniterSignedUrl\Exceptions\SignedUrlException;

class CounterSignedCell extends Cell
{
    public $count = 0;
    public $step = 1;

    public function mount()
    {
        // verify request only if query string is available
        if (service('incomingrequest')->getGet() !== []) {
            try {
                service('signedurl')->verify(service('incomingrequest'));
            } catch (SignedUrlException $e) {
                throw $e;
            }
        }
    }

    /**
     * Increment
     *
     * @return void
     */
    public function increment()
    {
        $this->count += $this->step;
        return $this->render();
    }

    /**
     * Decrement
     *
     * @return void
     */
    public function decrement()
    {
        $this->count -= $this->step;
        return $this->render();
    }

    /**
     * Get query string
     *
     * @return string;
     */
    public function getQueryString()
    {
        return http_build_query([
            'count' => $this->count,
            'step'  => $this->step,
        ]);
    }
}

