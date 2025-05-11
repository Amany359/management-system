<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:team_leader,programmer,tester,qa_manager,admin_manager'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
    }

    protected function registered(Request $request, $user)
    {
        // التوجيه مباشرة بعد التسجيل بناءً على الدور
        return redirect()->to($this->redirectToByRole($user->role));
    }

    // دالة لتوجيه المستخدم حسب الدور
    private function redirectToByRole($role)
    {
        return match($role) {
            'team_leader' => '/team-leader/dashboard',
            'admin_manager' => '/admin/dashboard',
            'programmer' => '/programmer/dashboard',
            'tester' => '/programmer/dashboard',
            'qa_manager' => '/qa-manager/dashboard',
            default => '/login',
        };
    }
}
