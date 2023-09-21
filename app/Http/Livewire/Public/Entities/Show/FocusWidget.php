<?php

namespace App\Http\Livewire\Public\Entities\Show;

use App\Models\Focus;
use Livewire\Component;

class FocusWidget extends Component
{
    public Focus $focus;

    public $eduCount;
    public $researchCount;
    public $careCount;

    public function mount() {
        $this->eduCount = $this->focus->edu_records_count;
        $this->researchCount = $this->focus->research_records_count;
        $this->careCount = $this->focus->care_records_count;
    }

    public function render()
    {
        return view('livewire.public.entities.show.focus-widget');
    }
}
