<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Symfony\Component\Mailer\Exception\TransportException;

class ForgotPasswordPage extends Component
{
    public $email;

    public function forgotPassword()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email|max:255'
        ]);

        try {
            $status = Password::sendResetLink(['email' => $this->email]);
        } catch (TransportException $e) {
            // This catches SMTP errors like your STARTTLS / cacert.pem issue
            session()->flash('error', 'Unable to send email. Please check your mail configuration.');
            return;
        }

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('success', 'Password reset link has been sent to your email');
            $this->email = '';
        } else {
            session()->flash('error', 'Unable to send password reset link. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password-page');
    }
}
