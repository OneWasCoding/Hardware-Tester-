<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\user;
use App\Models\account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
   public function edit(string $id)
   {
       //
       $user=user::where('account_id',$id)->first();
       $account=account::where('account_id',$id)->first();

       return view("admin.users.edit",compact('user','account'));
   }

   public function update_password(Request $request, string $id)
   {
       $rules = [
           'password' => 'required|min:8|confirmed',
           'password_confirmation' => 'required|min:8',
       ];

       $messages = [
           'password.required' => 'Password is required',
           'password.min' => 'Password must be at least 8 characters',
           'password.confirmed' => 'Passwords do not match',
       ];

       $validator = Validator::make($request->all(), $rules, $messages);

       if ($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput();
       }

       try {
           DB::beginTransaction();

           $user = user::findOrFail($id);
           $user->password = Hash::make($request->password);
           $user->save();

           DB::commit();
           return redirect()->route('user.index')->with('success', 'Password updated successfully');
       } catch (Exception $e) {
           DB::rollBack();
           Log::error('Error updating password: '.$e->getMessage());
           return redirect()->back()->with('error', 'Failed to update password');
       }
   }
      
   
   public function update(Request $request, string $id)
   {
       //
       $rules = [
           'fname' => 'required|min:2',
           'lname' => 'required|min:2|alpha',
           'age' => 'required|numeric|min:18',
           'contact' => 'required|digits:11',     
           'username' => 'required|email',
           'img' => 'nullable|mimes:jpeg,jpg,png'
       ];
   
       $messages = [
           'fname.required' => 'First name is required.',
           'lname.required' => 'Last name is required.',
           'age.required' => 'Age is required.',
           'contact.required' => 'Contact number is required.',
           'username.required' => 'Email is required.',
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
               $filename = $request->file('img')->store('user_img', 'public');
           }
   
           if ($request->has('current_img') && $filename) {
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
}
