<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Livewire\Attributes\Layout;


class MyProfile extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.settings.my-profile');
    }
}
