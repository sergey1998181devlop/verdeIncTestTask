<?php

namespace App\Services;

//use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Http\Controllers\API\ApiController as ApiController;
use App\Http\Requests\API\Auth\AgentsLoginRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\Agents;
use App\Services\Contracts\AgentsAuthServiceInterface;
//use Carbon\Carbon;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Config;
use \App\Http\Requests\API\Auth\AgentsRegisterRequest;

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
            $input['password'] = bcrypt($request->password);
            $user = Agents::create($input);

            return ApiController::sendResponse(new UserProfileResource($user), 'You have successfully registered', true);
        }

        return ApiController::sendError('Agents with this email already exists', ['status_code' => '409'], 409);
    }


    public function login(AgentsLoginRequest $request){
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
}
