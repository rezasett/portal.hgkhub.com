<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;

class DashboardAuditorSendWa extends Component
{
    #[layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.dashboard-auditor-send-wa');
    }
}
