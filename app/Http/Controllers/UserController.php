<?php

namespace App\Http\Controllers;

use App\Cores\ApiResponse;
use Facades\App\Http\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Get(
     *       path="/user/userlist",
     *       summary="Get list users ",
     *       description="Endpoint to get list users ",
     *       tags={"Users"},
     *       security={
     *           {"token": {}}
     *       },
     *
     *       @OA\Parameter(
     *           name="id",
     *           in="query",
     *           description="ID"
     *       ),
     *       @OA\Parameter(
     *           name="fullname",
     *           in="query",
     *           description="fullname"
     *       ),
     *       @OA\Parameter(
     *           name="username",
     *           in="query",
     *           description="Username"
     *       ),
     *       @OA\Parameter(
     *           name="sort",
     *           in="query",
     *           description="1 for Ascending -1 for Descending"
     *       ),
     *       @OA\Parameter(
     *           name="sort_by",
     *           in="query",
     *           description="Field to sort"
     *       ),
     *       @OA\Parameter(
     *           name="limit",
     *           in="query",
     *           description="Limit (Default 10)"
     *       ),
     *       @OA\Parameter(
     *           name="page",
     *           in="query",
     *           description="Num Of Page"
     *       ),
     *
     *       @OA\Response(
     *          response=200,
     *          description="Get list users successfully",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="data", type="object", example={}),
     *              @OA\Property(property="pagination", type="object", example={}),
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=400,
     *          description="Get list users failed",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="status", type="boolean", example=false),
     *              @OA\Property(property="message", type="string", example="Get list users failed"),
     *          )
     *      ),
     * )
     */
    public function index(Request $request)
    {
        $data = UserRepository::datatable($request);
        if (isset($data['status']) && ! $data['status']) {
            return $this->responseJson('error', $data['message'], $data['data']);
        }

        return $this->responseJson(
            'pagination',
            __('Get list users successfully'),
            $data,
            200,
            [$request->sort_by, $request->sort]
        );
    }
}
