<?php

namespace App\Http\Livewire\Public\Entities;

use App\Models\Focus;
use Livewire\Component;

class FocusIndex extends Component
{
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'focus' => null,
    ];

    public function clearSearch() {
        $this->reset('search');
    }

    public function clearFilters() {
        $this->reset('search');
        $this->reset('filters');
    }

    public function render()
    {
        return view('livewire.public.entities.focus-index', [
            'records' => Focus::with(['companies'])
                ->when($this->search, function($query, $search) {
                    return $query
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhereHas('companies', function($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('people', function($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('research', function($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('clinicaltrials', function($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                })
                ->when($this->filters['focus'], function($query) {
                    return $query->where('type', Focus::TYPE_DRUG);
                })
                ->orderBy('name')
                ->get()
        ]);
    }
}
