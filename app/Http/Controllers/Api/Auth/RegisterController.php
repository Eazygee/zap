<?php

namespace App\Http\Controllers\Api\Auth;

use App\Constants\General\ApiConstants;
use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Services\Auth\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = UserService::store($request->all());
            $data =  UserResource::make($user)->toArray($request);
            $data["token"] = $user->createToken('AuthToken')->plainTextToken;
            DB::commit();
            return ApiHelper::validResponse("User registration successful!", $data);
        } catch (ValidationException $e) {
            throw $e;
            return ApiHelper::inputErrorResponse("Invalid data", ApiConstants::VALIDATION_ERR_CODE, null, $e);
        } catch (Exception $e) {
            DB::rollBack();
            return ApiHelper::problemResponse("Something went wrong while processing your request", ApiConstants::BAD_REQ_ERR_CODE, null,  $e);
        }
    }
}
