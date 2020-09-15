<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Gate;
use \Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::orderBy('name', 'ASC')->get();
        return view ('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        if(Gate::denies('create-users')){
            return redirect(route('users.index'));
        }
        
            $roles = Role::all();
    
            return view('admin.users.create')->with([
                'user' => $user,
                'roles' => $roles
            ]); 
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
     public function store(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'name' => 'required|unique:users|min:5',
            'email' =>'required|email',
            'password' => 'required|confirmed|min:8',
            'type_id' => 'required',
            'phone' => 'required|digits:10',
        ], 
    );

    if ($validator->fails()) {
        // return $request;
        return redirect(route('users.create'))
                    ->withErrors($validator)
                    ->withInput();
    }
            $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'type_id' => $request['type_id'],
            'phone' => $request['phone'],
            'status_id' => '1',
            
        ]);
            

        
        // $data = $request->all();

        // $user = User::create($data);

        $user->roles()->sync($request->roles);
        

        // $role = Role::select('id')->where('name', 'employee')->first();

        // $user->roles()->attach($role);

        
       return redirect(route('users.index'));
    }

    public function updateStatus(Request $request, $user_id)
    {

        $user = User::find($user_id);
            // return $request;

       $data = $request->all();

       $user->update(['status_id'=>$data['status']]);

       return redirect(route('task.index'));

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
    public function edit(User $user)
    {

        if(Gate::denies('edit-users')){
            return redirect(route('users.index'));
        }

        $roles = Role::all();

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->type_id = $request->type_id;

        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('users.index'));
        }

        $user->type()-detach();
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('users.index');
    }
}
