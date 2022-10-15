<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\JsonRespondController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function auth;
use function event;

class AuthController extends Controller
{
    use JsonRespondController;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]);

            if($validateUser->fails()){
                return $this->respondUnauthorized([
                    'error_message' => 'validation error',
                    'errors' => $validateUser->errors()
                ]);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            event(new Registered($user));

            return $this->respond([
                'status' => true,
                'message' => 'User Created Successfully and the verification Email has been sent',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
            ]);

        } catch (\Throwable $th) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]);

            if($validateUser->fails()){
                return $this->respondUnauthorized([
                    'error_message' => 'validation error',
                    'errors' => $validateUser->errors()
                ]);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return $this->respondUnauthorized([
                    'error_message' => 'Email & Password does not match with our record.',
                ]);
            }

            $user = User::where('email', $request->email)->first();

            return $this->respond([
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ]);

        } catch (\Throwable $th) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        $user = auth()->user();

        foreach ($user->tokens as $token) {
            $token->delete();
        }

        return $this->respond([
            'message' => 'Logged out',
        ]);
    }
}
