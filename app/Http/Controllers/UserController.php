<?php

namespace App\Http\Controllers;

use App\User;
use App\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::leftJoin('roles', 'users.roles_id', '=', 'roles.id')
                    ->select(['users.id',
                              'users.name',
                              'users.username',
                              'users.email',
                            //   'roles.name AS roles'
                            DB::raw("(CASE WHEN (roles.name = 'su') THEN 'Super Admin'
                                        END) AS roles"),
                            //   'users.is_active',
                            DB::raw("(CASE WHEN (users.is_active = 'y') THEN 'Yes'
                                     ELSE 'No' END) AS is_active"),
                            ]);

        if ($request->ajax()) {
            return Datatables::of($user)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser"><ion-icon name="create"></ion-icon></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser"><ion-icon name="trash"></ion-icon></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //form validation
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles_id' => ['required'],
            'lockout_time' => ['required'],
            'is_active' => ['required'],
        ]);

        User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'roles_id' => $request['roles_id'],
            'lockout_time' => $request['lockout_time'],
            'is_active' => $request['is_active'],
        ]);
        
        return redirect()->route('user.index')
            ->with('success', 'New User added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->get();
        $roles = Roles::all();
        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //form validation
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'roles_id' => ['required'],
            'lockout_time' => ['required'],
            'is_active' => ['required'],
        ]);

        $user = User::find($id);
        $user->update([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'roles_id' => $request['roles_id'],
            'lockout_time' => $request['lockout_time'],
            'is_active' => $request['is_active'],
        ]);
        
        return redirect()->route('user.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return response()->json(['success' => 'User Data deleted successfully']);
    }

    public function changePwd()
    {
        return view('user.change_password');
    }

    public function change(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'new_password' => ['required', 'string', 'min:8'],
                'new_confirm_password' => ['same:new_password']
            ]);

            $id = $request['user_id'];
    
            $user = User::find($id);
            $user->update([
                'password' => Hash::make($request['new_password'])
            ]);
            return response()->json(['success' => 'Password Changed successfully']);
        } else {
            $request->validate([
                'current_password' => ['required', new MatchOldPassword],
                'new_password' => ['required'],
                'new_confirm_password' => ['same:new_password'],
            ]);
    
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
    
            return redirect()->back()
                ->with('success', 'Password Updated Successfully');
        }
    }
}
