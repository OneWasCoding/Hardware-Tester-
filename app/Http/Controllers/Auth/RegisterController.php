<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Account;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'fname' => 'required|min:2|regex:/^[a-zA-Z\s\-]+$/',
            'lname' => 'required|min:2|regex:/^[a-zA-Z\s\-]+$/',
            'age' => 'required|numeric|min:18',
            'contact' => 'required|digits:11|unique:users,contact',
            'email' => 'required|email|unique:accounts,email',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|in:male,female',
            'img' => 'nullable|mimes:jpeg,jpg,png|max:2048' // Limit file size to 2MB
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function create(Request $request)
    {
        // Handle the image upload
        $filename = null;
        if ($request->hasFile('profile_picture')) {
            $filename = $request->file('profile_picture')->hashName();
        }

        // Hash the password
        $hashedPassword = Hash::make($request->password);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create a new account
            $account = new Account();
            $account->username = $request->email; // Use email as username
            $account->email = $request->email;
            $account->password = $hashedPassword;
            $account->save();

            // Get the last inserted account ID
            $lastAccountId = $account->account_id;

            // Create a new user
            $user = new User();
            $user->account_id = $lastAccountId;
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->age = $request->age;
            $user->gender = $request->gender;
            $user->img = $filename;
            $user->contact = $request->contact;
            $user->address = $request->address;
            $user->save();

            // Store the image if provided
            if ($filename) {
                $path = $request->file('profile_picture')->storeAs('user_img', $filename, 'public');
                if (!$path) {
                    throw new \Exception('Failed to store the image.');
                }
            }

            view ('mails.registermail',compact('account', 'user'));
            Mail::send('mails.registermail', ['account' => $account, 'user' => $user], function ($message) use ($user, $account) {
                $message->to($account->email)
                        ->subject('Welcome to Our Platform');
            });
            // Commit the transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('login')->with('success', 'Account created successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            // Log the error and redirect with error message
            Log::error('Failed to create account: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create account. Please try again.')->withInput();
        }
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $this->validator($request)->validate();
        return $this->create($request);
    }
}