<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email'=> $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email'=> 'required',
            'password' => 'required',
        ]);

        //check mail
        $user = User::where('email',$fields['email'])->first();

        //check password
        if(!$user || !Hash::check($fields['password'],$user->password)) {
            return response([
                'message' => 'Bad credentials',
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->input("password")) {
            $fields = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);
            $user = $user->update([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'password' => bcrypt($fields['password']),
            ]);
        }else {
            $user = $user->update($request->all());
        }

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::destroy($id);
    }
    
    /**
     * Search the specified resource from storage.
     *
     * @param  str $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return User::where('name', 'like', '%'.$name.'%')->get();
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchComments($id)
    {
        $user = User::find($id);
        return $user->comments;
    }


    /**
     * Return the names of all users
     *
     * @return \Illuminate\Http\Response
     */
    public function getNames() {
        return User::pluck('name');
    }

    /**
     * Return the names of all users
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmails() {
        return User::pluck('email');
    }

    public function logout(Request $request) {
        // auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out',
        ];
    }
    public function userConnected(Request $request) {
        return auth()->user();
    }

    public function getUserByEmail($email) {
        return User::where('email', 'like', '%'.$email.'%')->first();
    }
}
