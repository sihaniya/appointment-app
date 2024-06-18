<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                $admin = Auth::guard('admin')->user();
                if ($admin->role === 'Admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    Auth::guard('admin')->logout();

                    $notification = array(
                        'message' => config("messages.auth.notAuthorized"),
                        'type' => 'error'
                    );
                    return redirect()->route('admin.login')->with($notification);
                }
            } else {
                $notification = array(
                    'message' => config("messages.auth.incorrectCredentials"),
                    'type' => 'error'
                );
                return redirect()->route('admin.login')->with($notification);
            }
        } else {
            return redirect()->route('admin.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Successfully logged out.');
    }
}
