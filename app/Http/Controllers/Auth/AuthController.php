<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    //
    use ApiResponser;

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return $this->errorResponse('These credentials don\'t match with our records.', Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        return $this->respondWithTokens($user);
    }

    private function respondWithTokens($user)
    {
        $accessToken = JWTAuth::fromUser($user);
        $user->roles;
        return response()->json([
            'access_token' => $accessToken,
            'user' => $user
        ]);
    }


    public function logout()
    {
        $data = Auth::logout();
        return $this->successResponse($data,  __('Logout successfully'), Response::HTTP_OK);
    }

    public function me()
    {
        return $this->successResponse(Auth::user(),  __('Logged in user'), Response::HTTP_OK);
    }

    public function refresh()
    {
        $data = [
            Auth::user(),
            Auth::refresh(),
        ];
        return $this->successResponse($data, __('Token refreshed successfully'), Response::HTTP_OK);
    }


    public function changePassword(Request $request)
    {
        try {

            $id = Auth::user()->id;
            // Find the user by email
            $user = User::where('id', $id)->first();

            // If user not found, return an error response
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
            if (Hash::check($request->password, $user->password)) {
                $user->update([
                    'password' => bcrypt($request->new_password)
                ]);
                // JWTAuth::invalidate(JWTAuth::getToken());
                return response()->json(['message' => 'Password reset successful']);
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Old Password donot Match'
            ], 404);
        } catch (\Exception $e) {
            // Handle any errors that occurred during token refresh
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to refresh token'
            ], 500);
        }
    }
}
