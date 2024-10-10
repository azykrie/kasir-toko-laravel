<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{

    public function logout()
    {
        Auth::logout();
        session()->invalidate(); 
        session()->regenerateToken();
        return redirect('/login');
    }
    public function render()
    {
        return view('livewire.auth.logout')->layout('components.layouts.main');
    }
}