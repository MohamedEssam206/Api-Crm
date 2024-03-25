<?php

namespace App\Http\Controllers;

use Crm\User\Requests\UserCreation;
use Crm\User\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;
    const TOKEN_NAME = 'personal';
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(UserCreation $request)
    {
       $user = $this->userService->Create($request);
       return  response()->json([
          'user' => $user,
           'token' => $user->createToken(self::TOKEN_NAME)->plainTextToken
       ]);
    }
}
