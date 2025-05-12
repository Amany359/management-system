<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        
// ✅ حفظ الدور الفعّال في السيشن
    session(['active_role' => $user->role]);

    
        return redirect()->to($this->redirectToByRole($user->role));
    }

    private function redirectToByRole($role)
    {
        return match($role) {
            'team_leader' => '/team-leader/dashboard',
            'admin_manager' => route('admin_manager.tasks.index'),
            'programmer' => '/programmer/dashboard',
            'tester' => '/programmer/dashboard',
            'qa_manager' => '/qa-manager/dashboard',
            default => '/login',
        };
    }
}
