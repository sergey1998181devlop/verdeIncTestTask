<?php
namespace App\Http\Controllers\API\Contacts;

use App\Http\Requests\API\Auth\ContactLoginRequest;
use App\Http\Requests\API\Auth\ContactRegisterRequest;
use Auth;
use App\Http\Controllers\Controller as Controller;
use App\Services\Contracts\ContactsAuthServiceInterface;

class AuthContactsController extends Controller
{

    private ContactsAuthServiceInterface $ContactsService;

    public function __construct(ContactsAuthServiceInterface $ContactsService)
    {
        $this->ContactsService = $ContactsService;
    }
    /**
     * @OA\Post(
     *     path="/api/auth/contact/register",
     *     operationId="registerContact",
     *     tags={"Contacts"},
     *     summary="Register for contact",
     *     @OA\Parameter(
     *         name="name",
     *         description="description login contact",
     *         example="testLogin",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="surname",
     *         description="description surname contact",
     *         example="testSurname",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="birthdate",
     *         description="description age contact",
     *         example="18/07/1998",
     *         required=false,
     *         in="path",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         description="description email contact",
     *         example="testEmail@gmail.com",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         example="testPassword",
     *         description="description password contact",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="success",
     *                         type="bool"
     *                     ),
     *                     @OA\Property(
     *                         property="bearerToken",
     *                         type="string"
     *                     ),
     *                 ),
     *
     *             )
     *         ),
     *     )
     * )
     */
    public function register(ContactRegisterRequest $request){
        return $this->ContactsService->register($request);
    }
    /**
     * @OA\Post(
     *     path="/api/auth/contact/login",
     *     operationId="loginContact",
     *     tags={"Contacts"},
     *     summary="Register for contact",
     *     @OA\Parameter(
     *         name="email",
     *         description="description email contact",
     *         example="testEmail@gmail.com",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         example="testPassword",
     *         description="description password contact",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="success",
     *                         type="bool"
     *                     ),
     *                     @OA\Property(
     *                         property="bearerToken",
     *                         type="string"
     *                     ),
     *                 ),
     *
     *             )
     *         ),
     *     )
     * )
     */
    public function login(ContactLoginRequest $request)
    {
        return $this->ContactsService->login($request);
    }
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function token()
    {
        return response()->json(auth('api')->user()->getRememberToken());
    }

    public function tokenId(){

        if (! $token = auth('api')->tokenById(Auth::user()->id)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['user'=>'logout']);
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
