<?php

namespace App\Http\Repositories;

use App\Http\Resources\UserResource;
use Facades\App\Models\User;
use Illuminate\Support\Facades\Log;

class UserRepository extends BaseRepository
{
    /**
     * Create / Register User
     *
     * @param  array  $data
     * @return array
     */
    public function register($data)
    {
        \DB::beginTransaction();
        try {
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);

            $data = new UserResource($user);

            \DB::commit();

            return $this->setResponseSuccess(__('Register user successfully'), $data);
        } catch (\Throwable $th) {
            //throw $th;
            \DB::rollback();
            Log::error($th);

            return $this->setResponseError(__('Register user failed'), $th->getMessage());
        }
    }
}
