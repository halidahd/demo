<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    use AuthenticatesUsers;

    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * API Login
     * POST: api/login
     *
     * @param Request $request
     */
    public function login(LoginRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $user = Auth::user();
            $token = $user->createToken('By Login from user:' . $user->email);
            $accessToken = $token->accessToken;

            $respone = [
                'status' => 1,
                'message' => trans('common.login_success'),
                'token' => $accessToken,

            ];

            return response()->json($respone);
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);

    }

    public function register(RegisterUserRequest $request)
    {
        $result = $this->userService->register($request);

        if (!$result) {
            $response = [
                'status' => 0,
                'message' => trans('common.create_failed'),
            ];
        } else {
            $response = [
                'status' => 1,
                'message' => trans('common.create_success'),
            ];
        }

        return response()->json($response);
    }

    public function update(UpdateUserRequest $request)
    {
        $result = $this->userService->update($request);

        if (!$result) {
            $response = [
                'status' => 0,
                'message' => trans('common.update_failed'),
            ];
        } else {
            $response = [
                'status' => 1,
                'message' => trans('common.update_success'),
            ];
        }

        return response()->json($response);
    }
}
