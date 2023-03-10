<?php

namespace App\Http\Repositories;

use App\Http\Resources\UserResource;
use App\Traits\DatatableTrait;
use Facades\App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserRepository extends BaseRepository
{
    use DatatableTrait;

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

    /**
     * Get Datatables Users
     *
     * @return Json|array
     */
    public function datatable(Request $request)
    {
        try {
            $query = User::query();

            $filters = [
                [
                    'field' => 'id',
                    'value' => $request->id,
                ],
                [
                    'field' => 'fullname',
                    'value' => $request->fullname,
                    'query' => 'like',
                ],
                [
                    'field' => 'username',
                    'value' => $request->username,
                ],
            ];
            $request->sort_by = $request->sort_by ?? 'id';
            $request->sort = $request->sort ?? -1;
            $data = $this->filterDatatable($query, $filters, $request);

            return UserResource::collection($data);
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th);

            return $this->setResponseError(__('Failed get users'), $th->getMessage());
        }
    }
}
