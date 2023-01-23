<?php

namespace App\Services;

use App\Http\Controllers\API\ApiController as ApiController;
use App\Http\Requests\API\Auth\AgentsLoginRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\Agents;
use App\Services\Contracts\AgentsAuthServiceInterface;

use \App\Http\Requests\API\Auth\AgentsRegisterRequest;

use Carbon\Carbon;
use http\Env\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgentsService implements AgentsAuthServiceInterface
{

    public function index($token)
    {
        return Agents::index($token);
    }



    public function register(AgentsRegisterRequest $request)
    {
        $user = Agents::where(['email' => $request->email])->first();
        if (!$user) {
            $input = $request->all();
            $user = Agents::create($input);

            return ApiController::sendResponse(new UserProfileResource($user), 'You have successfully registered', true);
        }

        return ApiController::sendError('Agent with this email already exists', ['status_code' => '409'], 409);
    }


    public function login(AgentsLoginRequest $request){
        $credentials = $request->only('email', 'password');
        //Request is validated
        //Creat token
        try {
//            if (! $token = Auth::attempt($credentials, ['exp' => Carbon::now()->addSecond(65)->timestamp])) {
            if (! $token = Auth::attempt($credentials)) {
                return ApiController::sendError('Login credentials are invalid', ['status_code' => '501']);
            }
        } catch (JWTException $e) {

            return ApiController::sendError('Could not create token', ['status_code' => '501']);
        }
        //Token created, return with success response and jwt token
        $success = [
            'success' => true,
            'token' => $token,
        ];
        return ApiController::sendResponse($success, 'You have successfully logged in to your account.', true);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function agentProfile() {
        if($user = auth()->user()){
            return ApiController::sendResponse($user, 'Your personal data', true);
        }else{
            return ApiController::sendError('you are not logged in or registered', ['status_code' => '404']);
        }
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return ApiController::sendResponse(['logout' => 'success'], 'you have successfully logged out of your account', true);
    }

}
