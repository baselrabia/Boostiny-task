<?php

namespace App\Services;


use App\Repositories\UserRepository;


class AuthService
{
    /**@var UserRepository $userRepo user repository instance */
    public $userRepo;

    /**
     * Undocumented function
     *
     * @param UserRepository $userRepo
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function checkUserStatusBeforeLogin($email)
    {
        $user = $this->userRepo->getFirstModelWhere('email', $email);

        if(! $user) {
            return "Invalid credentials";
        }

        return true;
    }



    /**
     * validated user credentials and return token
     *
     * @param string $email
     * @param string $password
     * @return void
     */
    public function userLogin($email, $password)
    {
        if (!$token = auth()->attempt(['email' => $email, 'password' => $password])) {
            return false;
        }

        return $this->prepareToken($token);
    }

    /**
     * refersh user token
     *
     * @return void
     */
    public function refreshUserToken()
    {
        return $this->prepareToken(auth()->refresh());
    }



    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    protected function prepareToken($token)
    {
        $user = auth()->user();


        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->roles->pluck('name'),
            'permissions' => $user->permissions->pluck('name'),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];
    }





}
