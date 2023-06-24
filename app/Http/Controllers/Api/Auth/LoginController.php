<?php

namespace App\Http\Controllers\Api\Auth;

use App\Constants\General\ApiConstants;
use App\Exceptions\UserException;
use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Services\Auth\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $user = AuthService::action($request->all());
            $data =  UserResource::make($user)->toArray($request);
            $data["token"] = $user->createToken('AuthToken')->plainTextToken;
            return ApiHelper::validResponse("User Logged In successfully", $data);
        } catch (ValidationException $e) {
            $message = "Input validation errors";
            return ApiHelper::inputErrorResponse("Input Error", ApiConstants::VALIDATION_ERR_CODE, null, $e);
        } catch (UserException $e) {
            $message = '';
            return ApiHelper::problemResponse("Error", ApiConstants::SERVER_ERR_CODE, null, $e);
        } catch (Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return ApiHelper::problemResponse($message, ApiConstants::BAD_REQ_ERR_CODE, null, $e);
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logout successful']);
    }
}
