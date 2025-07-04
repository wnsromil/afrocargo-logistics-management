<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PaginationToolbar extends Component
{
    public $pagination;
    public $perPageOptions;
    public $defaultPerPage;
    public $queryKey;

    public function __construct($pagination, $perPageOptions = [10, 20, 50, 100], $defaultPerPage = 10, $queryKey = 'per_page')
    {
        $this->pagination = $pagination;
        $this->perPageOptions = $perPageOptions;
        $this->defaultPerPage = $defaultPerPage;
        $this->queryKey = $queryKey;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pagination-toolbar');
    }
}
