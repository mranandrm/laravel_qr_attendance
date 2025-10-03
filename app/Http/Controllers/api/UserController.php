<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
      public function isMobileNoRegistered(Request $request)
    {
        $mobile_no = $request->input('mobile_no');

        // Validate the input if needed

        $user = new User();

        if ($user->isMobileNoRegistered($mobile_no)) {
            return response()->json(['status' => 'success', 'message' => 'Mobile No is registered']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Mobile No is not registered']);
        }
    }
}
