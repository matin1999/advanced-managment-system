<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\JsonResponse
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
            return response()->json([
                'status' => false,
                'message' => '',
                'errors' => $validateUser->errors()
            ], 401);
        }
        $user = $this->userRepository->CreateUser([
            'name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'user registered',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ]);

        } else {
            return response()->json([
                'status' => false,
                'message' => 'try again'
            ], 500);
        }

    }

    /**
     * Login The User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'email and password are required',
                'errors' => $validateUser->errors()
            ], 401);
        }

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ]);

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
