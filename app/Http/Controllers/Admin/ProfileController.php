<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index()
    {
        $page_title = "Profile";
        $page_breadcrumbs = array(
            array('title' => 'Dashboard', 'url' => route('admin.dashboard'), 'active' => false),
            array('title' => 'Profile', 'url' => 'javascript:void(0);', 'active' => true)
        );

        $user = Auth::user();

        return view('admin.profile.index', compact('page_title', 'page_breadcrumbs', 'user'));
    }

    public function update_profile_image(Request $request)
    {
        $data = array();
        $validator = Validator::make($request->all(), [
            "profile_image" => 'required'
        ]);

        if ($validator->passes()) {
            $auth_user = Auth::user();
            $user = User::where('id', $auth_user->id)->first();

            $photo = $request->profile_image;
            if (isset($photo) && $photo != "") {
                if (File::exists(public_path($user->profile_image))) {
                    File::delete(public_path($user->profile_image));
                }

                $filename = time() . "_" . $photo->getClientOriginalName();
                $upload_path = public_path() . "/uploads/user_photos/" . $auth_user->id . "/";
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }
                $photo->move($upload_path, $filename);
                // $photo_url = url("/uploads/user_photos/" . $auth_user->id . "/" . $filename);
                $photo_url = "/uploads/user_photos/" . $auth_user->id . "/" . $filename;
                $user->profile_image = $photo_url;
                $user->save();

                $data = array(
                    "message" => "Profile Updated Successfully!",
                    "type" => "success",
                    "success" => true
                );
            } else {
                $data = array(
                    "message" =>  "Something went wrong!",
                    "type" => "error",
                    "success" => false
                );
            }
        } else {
            $data = array(
                "message" => "Something went wrong!",
                "type" => "error",
                "success" => false
            );
        }

        return response()->json($data, 200);
    }

    public function change_password(Request $request)
    {
        $data = array();
        $validator = Validator::make($request->all(), [
            "old_password" => 'required',
            "password" => 'required'
        ]);

        if ($validator->passes()) {
            $auth_user = Auth::user();
            $user = User::where('id', $auth_user->id)->first();
            $match = Hash::check($request->old_password, $auth_user->getAuthPassword());

            if ($match) {
                $user->password = Hash::make($request->password);
                $user->save();

                $data = array(
                    "message" => "Password Updated Successfully!",
                    "type" => "success",
                    "success" => true
                );
            } else {
                $data = array(
                    "message" => "Password did not matched!",
                    "type" => "validation",
                    "success" => false
                );
            }
        } else {
            return response()->json(array("success" => false, "type" => 'validation', 'errors' => $validator->messages()))
                ->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY, Response::$statusTexts[Response::HTTP_UNPROCESSABLE_ENTITY]);
        }

        return response()->json($data, 200);
    }
}
