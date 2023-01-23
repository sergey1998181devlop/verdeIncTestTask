<?php
namespace App\Http\Controllers\API\Agents;

use App\Http\Requests\API\Auth\AgentsLoginRequest;
use App\Http\Requests\API\Auth\AgentsRegisterRequest;
use Auth;
use App\Http\Controllers\Controller as Controller;
use App\Services\Contracts\AgentsAuthServiceInterface;

class AuthAgentsController extends Controller
{

    private AgentsAuthServiceInterface $AgentsService;

    public function __construct(AgentsAuthServiceInterface $AgentsService)
    {
        $this->AgentsService = $AgentsService;
    }
    /**
     * @OA\Post(
     *     path="/api/auth/agents/register",
     *     operationId="registerAgents",
     *     tags={"Agents"},
     *     summary="Register for agents",
     *     @OA\Parameter(
     *         name="name",
     *         description="description login agents",
     *         example="testLogin",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="surname",
     *         description="description surname agents",
     *         example="testSurname",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="birthdate",
     *         description="description age agents",
     *         example="18/07/1998",
     *         required=false,
     *         in="path",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         description="description email agents",
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
     *         description="description password agents",
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
     *                 @OA\Property(
     *                     property="success",
     *                     type="bool",
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                     example="You have successfully registered"
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     @OA\Items(
     *                          @OA\Property(
     *                              property="name",
     *                              example="testName",
     *                              type="string"
     *                         ),
     *                          @OA\Property(
     *                              property="surname",
     *                              example="surnameTest",
     *                              type="string"
     *                         ),
     *                         @OA\Property(
     *                             property="email",
     *                             example="test@mail.ru",
     *                             type="string"
     *                         ),
     *                         @OA\Property(
     *                             property="email_verified_at",
     *                             example="null | 2023-01-22 23:10:27",
     *                             type="string"
     *                         ),
     *                         @OA\Property(
     *                             property="date_of_birth",
     *                             example="null | 1998-18-12",
     *                             type="string"
     *                         ),
     *                         @OA\Property(
     *                             property="created_at",
     *                             example="2023-01-22 23:10:27",
     *                             type="string"
     *                         ),
     *                         @OA\Property(
     *                             property="updated_at",
     *                             example="2023-01-22 23:10:27",
     *                             type="string"
     *                         ),
     *                     ),
     *                 ),
     *             )
     *         ),
     *     )
     * )
     */
    public function register(AgentsRegisterRequest $request){
        return $this->AgentsService->register($request);
    }
    /**
     * @OA\Post(
     *     path="/api/auth/agents/login",
     *     operationId="loginAgents",
     *     tags={"Agents"},
     *     summary="Login for agents",
     *     @OA\Parameter(
     *         name="email",
     *         description="description email agents",
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
     *         description="description password agents",
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
     *                         example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sLnZlcmRlLmxvY1wvYXBpXC9hdXRoXC9hZ2VudHNcL2xvZ2luIiwiaWF0IjoxNjc0NDMxODg4LCJleHAiOjE2NzQ0MzU0ODgsIm5iZiI6MTY3NDQzMTg4OCwianRpIjoiTUN1N2dzcXllREdVUVNaMSIsInN1YiI6MTUsInBydiI6IjczM2ZkNzg0Yzc4NmI3ZTUwM2FjZmU0ZGFhOTMwMDNjZWRkNmVlYmIifQ.jSOnS-ydYXc53KS0URwxNHY0Gy43YU8EEf9oSSvlSKY",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="message",
     *                         example="You have successfully logged in to your account.",
     *                         type="string"
     *                     ),
     *                 ),
     *
     *             )
     *         ),
     *     )
     * )
     */
    public function login(AgentsLoginRequest $request)
    {
        return $this->AgentsService->login($request);
    }
    /**
     * @OA\Post(
     *     path="/api/auth/agents/profile",
     *     operationId="profileCatalog",
     *     tags={"Agents"},
     *     security={
     *          {"Bearer": {}}
     *     },
     *     summary="Getting profile data for an agent",
     *      description="Protected bearer-token",
     *         @OA\Parameter(
     *          name="bearer",
     *          description="bearer-token user",
     *          example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sLnZlcmRlLmxvY1wvYXBpXC9hdXRoXC9hZ2VudHNcL2xvZ2luIiwiaWF0IjoxNjc0NDMxODg4LCJleHAiOjE2NzQ0MzU0ODgsIm5iZiI6MTY3NDQzMTg4OCwianRpIjoiTUN1N2dzcXllREdVUVNaMSIsInN1YiI6MTUsInBydiI6IjczM2ZkNzg0Yzc4NmI3ZTUwM2FjZmU0ZGFhOTMwMDNjZWRkNmVlYmIifQ.jSOnS-ydYXc53KS0URwxNHY0Gy43YU8EEf9oSSvlSKY",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="bool",
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                     example="Your personal data"
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     @OA\Items(
     *                          @OA\Property(
     *                              property="name",
     *                              example="testName",
     *                              type="string"
     *                         ),
     *                          @OA\Property(
     *                              property="surname",
     *                              example="surnameTest",
     *                              type="string"
     *                         ),
     *                         @OA\Property(
     *                             property="email",
     *                             example="test@mail.ru",
     *                             type="string"
     *                         ),
     *                         @OA\Property(
     *                             property="email_verified_at",
     *                             example="null | 2023-01-22 23:10:27",
     *                             type="string"
     *                         ),
     *                         @OA\Property(
     *                             property="date_of_birth",
     *                             example="null | 1998-18-12",
     *                             type="string"
     *                         ),
     *                         @OA\Property(
     *                             property="created_at",
     *                             example="2023-01-22 23:10:27",
     *                             type="string"
     *                         ),
     *                         @OA\Property(
     *                             property="updated_at",
     *                             example="2023-01-22 23:10:27",
     *                             type="string"
     *                         ),
     *                     ),
     *                 ),
     *             )
     *         ),
     *     )
     * )
     */
    public function agentProfile(){
        return $this->AgentsService->agentProfile();
    }
    /**
     * @OA\Post(
     *     path="/api/auth/agents/logout",
     *     operationId="logoutAgents",
     *     tags={"Agents"},
     *     summary="logoutAgents for agents",
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                      @OA\Property(
     *                          property="success",
     *                          type="bool"
     *                     ),
     *                      @OA\Property(
     *                          property="message",
     *                          type="string",
     *                          example="You have successfully logged out of your account"
     *                      ),
     *                      @OA\Property(
     *                          property="data",
     *                          type="array",
     *                          @OA\Items(
     *                              @OA\Property(
     *                                  property="logout",
     *                                  example="success",
     *                                  type="string"
     *                              )
     *                          ),
     *                      ),
     *                 ),
     *             )
     *         ),
     *     )
     * )
     */
    public function logout(){
        return $this->AgentsService->logout();
    }
}
