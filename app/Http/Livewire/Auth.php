<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\AuthService;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Auth extends Component
{
    use LivewireAlert;
    protected $listeners = [
        "submit" => "submit",
        'logout' => 'logout',
    ];

    public $email = '';
    public $password = '';

    public $is_auth = false;

    public function mount($is_auth = false)
    {
        $this->is_auth = $is_auth;
    }

    public function render()
    {
        return view('livewire.auth');
    }

    public function submit(AuthService $authService)
    {
        $validator = Validator::make([
            "email" => $this->email,
            "password" => $this->password,
        ], [
            "email" => ['required', 'email'],
            "password" => ["required"],
        ], [
            "email.required" => "This field is required",
            "email.email" => "This field must be a valid email",
            "password.required" => "This field is required",
        ]);

        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());
        if (count($errors)) {
            $this->emit('errors', $errors);
            return  false;
        }

        if ($validator->passes()) {

            $data = $validator->validated();
            $result = $authService->login($data);

            if ($result == "password") {
                $this->emit('errors', ['email' => "Password is incorrect"]);
                return false;
            }

            if ($result == "email") {
                $this->emit('errors', ['email' => "Email is incorrect"]);
                return false;
            }

            if ($result == "error") {
                $this->alert('error', 'لقد حدث خطأ غير متوقع، يرجى مراجعة الدعم الفني', [
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => true,
                    'timerProgressBar' => true,
                ]);
                return false;
            }

            return $result;
        }
    }

    public function logout(AuthService $authService)
    {
        return $authService->logout();
    }
}
