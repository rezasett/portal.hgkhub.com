<?php

namespace App\Livewire\Dareq;

use Livewire\Component;
use Livewire\Attributes\Layout;
class DareqClientNotifWa extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dareq.dareq-client-notif-wa');
    }
}
