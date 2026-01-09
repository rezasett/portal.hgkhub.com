<?php

namespace App\Livewire\Settings;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Psettings extends Component
{
     #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.settings.psettings');
    }
}
