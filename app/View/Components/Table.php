<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public $columns;
    public $data;
    public $actions;
    public $customFields;

    /**
     * Create a new component instance.
     */
    public function __construct($columns, $data, $actions = [], $customFields = [])
    {
        $this->columns = $columns;
        $this->data = $data;
        $this->actions = $actions;
        $this->customFields = $customFields;
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table');
    }
}

