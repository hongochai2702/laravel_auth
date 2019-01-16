<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::whereNull('approved_at')->get();
    	$users = User::all();

    	return view('users', compact('users'));
    }

    public function show_edit($user_id)
    {
        $user = User::where(['id' => $user_id])->first();
        return view('users_form', compact('user'));
    }

    /**
     * Get a validator for an incoming edit account request.
     * @param array $data
     * @return \Illuminate\Http\Validator
     */

    /*public function validator( Request $request )
    {
        return Validator::make($request, [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
    }
*/
    /**
     * Update user instance after a valid submit.
     * @param Request $r
     * @return \App\User 
     */
    public function post_edit(Request $request, $user_id) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        
        if ($validator->fails()) {
            return redirect()
                        ->route('admin.users.show_edit', $user_id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::findOrFail($user_id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'admin' => ($request->input('is_admin') == 'yes') ? 1 : 0,
            'approved_at' => ($request->input('approve_status') == 'yes') ? date("Y-m-d H:i:s") : null,
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        return redirect()->route('admin.users.index')->withMessage('User updated successfully');
    }

    public function approve($user_id)
    {
    	$user = User::findOrFail($user_id);
    	$user->update(['approved_at' => date("Y-m-d H:i:s")]);

    	return redirect()->route('admin.users.index')->withMessage('User approved successfully');
    }
}
