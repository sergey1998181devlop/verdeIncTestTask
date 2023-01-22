<?php

namespace App\Services;

//use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Http\Controllers\API\ApiController as ApiController;
use App\Http\Requests\API\Auth\ContactLoginRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\Contacts;
use App\Services\Contracts\ContactsAuthServiceInterface;
//use Carbon\Carbon;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Config;
use \App\Http\Requests\API\Auth\ContactRegisterRequest;

class ContactsService implements ContactsAuthServiceInterface
{

    public function index($token)
    {
        return Contacts::index($token);
    }



    public function register(ContactRegisterRequest $request)
    {
        $user = Contacts::where(['email' => $request->email])->first();
        if (!$user) {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
            $user = Contacts::create($input);

            return ApiController::sendResponse(new UserProfileResource($user), 'You have successfully registered', true);
        }

        return ApiController::sendError('Contact with this email already exists', ['status_code' => '409'], 409);
    }


    public function login(ContactLoginRequest $request){
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
}
