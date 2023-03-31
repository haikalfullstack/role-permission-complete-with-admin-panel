<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }

    public function AdminLogin(){
        return view('admin.admin_login');
    }

    public function AdminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));

        
    }

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->username = $request->username;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
@unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data->photo = $filename;
        }

        $data->save();
        $notification = array(
            'message' => "Admin Profile Updated Successfully",
            'alert-type' => "success"
        );
        return redirect()->back()->with($notification);

    }

    public function AdminChangePassword(){
        return view('admin.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request){
        // validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match the old password
        if(!Hash::check($request->old_password, auth::user()->password)){
            return back()->with('error', 'Old password does not match');
        }

        // Update new password
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('status', 'Password changed successfully');

    }

    // Admin all method
    public function AllAdmin(){
        $alladminuser = User::where('role', 'admin')->latest()->get();
        return view('backend.admin.all_admin', compact('alladminuser'));
    }

    public function AddAdmin(){
        $roles = Role::all();
        return view('backend.admin.add_admin', compact('roles'));
    }

    public function AdminUserStore(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if($request->roles){
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => "New Admin User Inserted Successfully",
            'alert-type' => "success"
        );
        return redirect()->route('all.admin')->with($notification);
    }

    public function EditAdminRole($id){
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.admin.edit_admin', compact('user', 'roles'));
    }

    public function AdminUserUpdate(Request $request, $id){
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
  
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();
        if($request->roles){
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => "New Admin User Updated Successfully",
            'alert-type' => "success"
        );
        return redirect()->route('all.admin')->with($notification);
    }

    public function DeleteAdminRole($id){
        $user = User::findOrFail($id);
        if(!is_null($user)){
            $user->delete();
        }

        $notification = array(
            'message' => "Admin User Deleted Successfully",
            'alert-type' => "success"
        );
        return redirect()->back()->with($notification);
    }
}
