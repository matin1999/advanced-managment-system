<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class AuthController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Create User
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $validateUser = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);
        if ($validateUser->fails()) {
            return redirect()->back()->with('errors' , $validateUser->errors());
        }
        $user = $this->userRepository->CreateUser([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        if ($user) {
            return redirect()->route('login')->with('status',true);

        } else {
            return redirect()->back()->with('errors','try again');

        }

    }

    /**
     * Login The User
     * @param Request $request
     */
    public function login(Request $request)
    {
        $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

        if ($validateUser->fails()) {
            return redirect()->back('errors' , $validateUser->errors());
        }

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->back()->with('errors' , ['Email & Password does not match with our record.'],);
        }
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.admin_dashboard');
        }

    }

    public function registerView()
    {
        return view('auth.register');
    }
    public function loginView()
    {
        return view('auth.login');
    }
}
