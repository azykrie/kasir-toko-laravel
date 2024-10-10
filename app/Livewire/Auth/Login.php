<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
#[Title('Login')]
class Login extends Component
{
    public $email, $password;
    public $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    public function login()
    {
        $this->validate();

        if (\Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('/dashboard');
            } elseif (Auth::user()->role == 'cashier') {
                return redirect()->intended('/transaction');
            } elseif (Auth::user()->role == 'staff') {
                return redirect()->intended('/product');
            }
        } else {
            session()->flash('error', 'The provided credentials do not match our records.');
            return redirect();
        }

    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.auth');
    }
}
