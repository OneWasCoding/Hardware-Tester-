<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use App\DataTables\userDataTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(userDataTable $user_data_table)
    {
        return $user_data_table->render("admin.users.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */  
    public function viewProfile()
    {
        $account = Auth::user(); // returns logged in Account model
        $user = $account->user;  // uses the hasOne() relationship
    
        return view('customer.profile.view', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request)
    // {
    //     $user = Auth::user();
        
    //     $request->validate([
    //         'fname' => 'required|string|max:255',
    //         'lname' => 'required|string|max:255',
    //         'age' => 'required|numeric|min:18',
    //         'gender' => 'required|in:male,female,other',
    //         'contact' => 'required|string|max:255',
    //         'img' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
    //     ]);

    //     $userData = [
    //         'fname' => $request->fname,
    //         'lname' => $request->lname,
    //         'age' => $request->age,
    //         'gender' => $request->gender,
    //         'contact' => $request->contact,
    //     ];

    //     if ($request->hasFile('img')) {
    //         if ($user->img) {
    //             Storage::disk('public')->delete('profile_images/' . $user->img);
    //         }

    //         $image = $request->file('img');
    //         $filename = time() . '.' . $image->getClientOriginalExtension();
    //         $image->storeAs('profile_images', $filename, 'public');
    //         $userData['img'] = $filename;
    //     }

    //     $user->update($userData);

    //     return redirect()->back()->with('success', 'Profile updated successfully!');
    // }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        //
    }
}
