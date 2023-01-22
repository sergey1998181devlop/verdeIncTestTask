<?php

namespace App\Services\Contracts;

use App\Http\Requests\API\Auth\ContactLoginRequest;
use App\Http\Requests\API\Auth\ContactRegisterRequest;
use Illuminate\Http\Request;

interface ContactsAuthServiceInterface
{
    public function register(ContactRegisterRequest $request);

    public function index($token);

    public function login(ContactLoginRequest $request);
}
