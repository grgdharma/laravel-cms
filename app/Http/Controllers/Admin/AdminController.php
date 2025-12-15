<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of admins.
     */
    public function index()
    {
        if (!checkAuthorization()) {
            abort(401);
        }

        $roles = AdminRole::where('id', '!=', 1)->get();
        $authAdmin = Auth::guard('admin')->user();

        $admins = Admin::query()
            ->when($authAdmin->role_id != 1, fn ($q) =>
                $q->where('role_id', '!=', 1)
            )
            ->orderBy('name')
            ->get();

        return view('admin.user.admin', [
            'role'  => $roles,
            'admin' => $admins,
        ]);
    }

    /**
     * Store a newly created admin.
     */
    public function store(AddAdminRequest $request)
    {
        Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role_id'  => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Your item has been created.');
    }

    /**
     * Show admin edit form (AJAX).
     */
    public function edit(Request $request)
    {
        $admin = Admin::findOrFail($request->model_id);

        return view('admin.user.ajax', [
            'role' => AdminRole::where('id', '!=', 1)->get(),
            'edit' => $admin,
            'id'   => $admin->id,
        ]);
    }

    /**
     * Update admin data.
     */
    public function update(UpdateAdminRequest $request, $id)
    {
        $data = [
            'name'    => $request->name,
            'role_id' => $request->role,
        ];
        $admin = Admin::findOrFail($id);
        if ($request->filled('new_password')) {
            if (!Hash::check($request->old_password, $admin->password)) {
                return back()->with('error', "Please enter your correct current password.");
                
            }
            $data['password'] = Hash::make($request->new_password);
        }
        $admin->update($data);
        return back()->with('success', 'Your item has been updated.');
    }

    /**
     * Remove admin.
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return back()->with('success', 'Your item has been deleted.');
    }
}