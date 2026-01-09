<?php

namespace App\Livewire\Notif;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Notification extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.notif.notification');
    }
}
