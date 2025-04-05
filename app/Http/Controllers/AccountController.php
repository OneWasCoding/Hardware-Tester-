<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\user;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'fname' => 'required|min:2',
            'lname' => 'required|min:2|alpha',
            'age' => 'required|numeric|min:18',
            'contact' => 'required|digits:11',     
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'confirm-password' => 'required|same:password',
            'img' => 'mimes:jpeg,jpg,png'
        ];
        
        $messages = [
            'fname.required' => 'First name is required.',
            'fname.min' => 'First name must be at least 2 characters.',
            'fname.alpha' => 'First name must only contain letters.',
        
            'lname.required' => 'Last name is required.',
            'lname.min' => 'Last name must be at least 2 characters.',
            'lname.alpha' => 'Last name must only contain letters.',
        
            'age.required' => 'Age is required.',
            'age.numeric' => 'Age must be a number.',
            'age.min' => 'You must be at least 18 years old.',
        
            'contact.required' => 'Contact number is required.',
            'contact.digits' => 'Contact number must be exactly 11 digits.',
        
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
        
            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a string.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Passwords do not match.',
        
            'img.mimes' => 'Image must be in JPEG, JPG, or PNG format.'
        ];
        
        $validator=validator($request->all(),$rules, $messages);

        if($validator->fails()){ 
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $filename = $request->hasFile('img') ? $request->file('img')->hashName() : null;
            $hashpassword=hash::make($request->password);
            try{
                DB::beginTransaction();
                $account=new account();
                $account->username=$request->username;
                $account->email=$request->email;
                $account->password=$hashpassword;  
            if($account->save()){
                $last_id=$account->id;
                $user_info= new user();
                $user_info->account_id=$last_id;
                $user_info->fname=$request->fname;
                $user_info->lname=$request->lname;
                $user_info->age=$request->age;
                $user_info->gender=$request->gender;
                $user_info->img=$filename;
                $user_info->contact=$request->contact;
                if($user_info->save()){
                    if($filename!=null){
                        $path=$request->file('img')->storeAs('user_img',$filename,'public');
                    if ($path) {
                            // return Redirect::route('customer.index');
                            DB::commit();
                            echo "Success";
                        }
                    }else{
                        DB::commit();
                        echo "Success2";
                    }
                    
                    }
                }   

            }catch(\Exception $e){
                DB::rollBack();
                echo "failed to store to the database". $e->getMessage();
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=user::where('account_id',$id)->first();
        $account=account::where('account_id',$id)->first();

        return view("admin.users.edit",compact('user','account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // dd($request->all());
        $rules = [
            'fname' => 'required|min:2',
            'lname' => 'required|min:2|alpha',
            'age' => 'required|numeric|min:18',
            'contact' => 'required|digits:11',     
            'img' => 'nullable|mimes:jpeg,jpg,png'
        ];
    
        $messages = [
            'fname.required' => 'First name is required.',
            'lname.required' => 'Last name is required.',
            'age.required' => 'Age is required.',
            'contact.required' => 'Contact number is required.',
            'img.mimes' => 'Image must be in JPEG, JPG, or PNG format.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        DB::beginTransaction();
    
        try {
            $filename = null;
            if ($request->hasFile('img')) {
                $filename=$request->file("img")->hashName();
                $path = $request->file('img')->storeAs('user_img',$filename, 'public');
            }
            
            // dd($request->img);
            if ($request->has('current_img') && $request->img!= null) {
                $old_img = $request->current_img;
                if ($old_img && Storage::disk('public')->exists('user_img/' . $old_img)) {
                    Storage::disk('public')->delete('user_img/' . $old_img);
                }
            }
    
            account::where('account_id', $id)->update([
                'username' => $request->username
            ]);
    
            $userData = [
                'fname' => $request->fname,
                'lname' => $request->lname,
                'age' => $request->age,
                'gender' => $request->gender,
                'contact' => $request->contact,
                'updated_at' => now()
            ];
    
            if ($filename) {
                $userData['img'] = $filename;
            }
    
            user::where('account_id', $id)->update($userData);
    
            DB::commit();
    
            return redirect()->route("user.index")->with("success", "Successfully updated the account.");
        
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", "Failed to update the account. Error: " . $e->getMessage());
        }
    }
    
    public function destroy(account $account)
    {
        //
    }

    public function update_password(Request $request,$id){
    if ($request->password != $request->confirm_password) {
        return redirect()->back()->with('error', 'Password and Confirm Password do not match.');
    }
        DB::table('accounts')
        ->where('account_id', $id)
        ->update([
            'password' => Hash::make($request->password),
        ]);

    return redirect()->back()->with('success', 'Password updated successfully!');    }
}
