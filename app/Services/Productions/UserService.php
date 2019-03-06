<?php
namespace App\Services\Productions;

use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function register(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password'] );

        return User::create($data);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->except('email');

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password'] );
        }

        return $user->update($data);
    }
}