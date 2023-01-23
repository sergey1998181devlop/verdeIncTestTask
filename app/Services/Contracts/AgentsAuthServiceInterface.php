<?php

namespace App\Services\Contracts;

use App\Http\Requests\API\Auth\AgentsLoginRequest;
use App\Http\Requests\API\Auth\AgentsRegisterRequest;
use Illuminate\Http\Request;

interface AgentsAuthServiceInterface
{
    public function register(AgentsRegisterRequest $request);

    public function index($token);

    public function login(AgentsLoginRequest $request);

    public function agentProfile();
}
