<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ModernDataTable extends Component
{
    // Props yang dapat diterima dari parent component
    public $title = '';
    public $subtitle = '';
    public $searchPlaceholder = 'Cari data...';
    public $columns = [];
    public $data = [];
    public $rowView = ''; // View partial untuk row
    public $rowData = []; // Additional data untuk row
    public $showSearch = true;
    public $showPerPage = true;
    public $showHeader = true;
    public $showPagination = true;
    public $emptyStateTitle = 'Tidak Ada Data';
    public $emptyStateText = 'Saat ini tidak ada data yang tersedia.';
    public $emptyStateIcon = 'bx-file-blank';
    public $headerActions = [];
    public $tableClass = '';
    public $containerClass = '';
    
    // Search dan pagination
    public $search = '';
    public $perPage = 10;
    public $sortBy = '';
    public $sortDir = 'ASC';
    
    protected $listeners = [
        'refreshTable' => '$refresh',
        'updateSearch' => 'updateSearch',
        'updateSort' => 'updateSort'
    ];

    public function mount(
        $title = '',
        $subtitle = '',
        $searchPlaceholder = 'Cari data...',
        $columns = [],
        $data = [],
        $rowView = '',
        $rowData = [],
        $showSearch = true,
        $showPerPage = true,
        $showHeader = true,
        $showPagination = true,
        $emptyStateTitle = 'Tidak Ada Data',
        $emptyStateText = 'Saat ini tidak ada data yang tersedia.',
        $emptyStateIcon = 'bx-file-blank',
        $headerActions = [],
        $tableClass = '',
        $containerClass = ''
    ) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->searchPlaceholder = $searchPlaceholder;
        $this->columns = $columns;
        $this->data = $data;
        $this->rowView = $rowView;
        $this->rowData = $rowData;
        $this->showSearch = $showSearch;
        $this->showPerPage = $showPerPage;
        $this->showHeader = $showHeader;
        $this->showPagination = $showPagination;
        $this->emptyStateTitle = $emptyStateTitle;
        $this->emptyStateText = $emptyStateText;
        $this->emptyStateIcon = $emptyStateIcon;
        $this->headerActions = $headerActions;
        $this->tableClass = $tableClass;
        $this->containerClass = $containerClass;
    }

    public function updateSearch($value)
    {
        $this->search = $value;
        $this->dispatch('searchUpdated', $value);
    }

    public function updateSort($field, $direction)
    {
        $this->sortBy = $field;
        $this->sortDir = $direction;
        $this->dispatch('sortUpdated', $field, $direction);
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = $this->sortDir === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->sortBy = $sortByField;
            $this->sortDir = 'ASC';
        }

        $this->dispatch('sortUpdated', $this->sortBy, $this->sortDir);
    }

    public function render()
    {
        return view('livewire.components.modern-data-table', [
            'tableData' => $this->data
        ]);
    }
}
