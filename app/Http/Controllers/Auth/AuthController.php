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
        $accessToken = JWTAuth::fromUser($user);
        $refreshToken = JWTAuth::fromUser($user);

        return $this->respondWithTokens($accessToken, $refreshToken, $user);
    }

    private function respondWithTokens($accessToken, $refreshToken, $user)
    {
        return response()->json([
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'token_type' => 'bearer', // Optional for better client-side handling
            'expires_in' => JWTAuth::factory()->getTTL() * 60, // Convert TTL to seconds
            'user' => $user
        ]);
    }

    public function refresh(Request $request)
    {

        $oldToken = $request->refresh_token;
        $oldToken = JWTAuth::getToken();
        $token = JWTAuth::refresh($oldToken);
        $user = Auth::user();
        $refreshToken = JWTAuth::fromUser($user);
        return $this->respondWithTokens($token, $refreshToken, $user);
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

    // public function authTokenRefresh(Request $request)
    // {
    //     $refreshToken = request()->get('refresh_token');

    //     $result = JWTAuth::refresh($refreshToken); // Use current token for refresh

    //     if ($result) {
    //         return response()->json([
    //             'success' => true,
    //             'access_token' => $result,
    //             'token_type' => 'bearer', // Optional for better client-side handling
    //             'expires_in' => JWTAuth::factory()->getTTL() * 60 // Convert TTL to seconds
    //         ]);
    //     } else {
    //         return response()->json(['error' => 'Refresh token is invalid'], 401);
    //     }
    // }



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
