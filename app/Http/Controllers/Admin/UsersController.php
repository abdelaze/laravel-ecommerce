<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\UsersDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function index(UsersDatatable $admin)
    {
        return $admin->render('admin.users.index',['title'=>'User controller']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create',['title'=>trans("admin.create")]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(),[
             'name' =>'required',
               'level' =>'required|in:user,company,vendor',
             'email'=>'required|unique:users',
             'password'=>'required|min:6',
        ],[],[
          'name' => trans('admin.name'),
          'email' => trans('admin.email'),
          'password' => trans('admin.password'),
        ]);

        $data['password'] =bcrypt(request('password'));
        User::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =  User::find($id);
        $title = trans('admin.edit');
        return view('admin.users.edit',compact('title','admin'));
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
      $data = $this->validate(request(),[
           'name' =>'required',
           'level' =>'required|in:user,company,vendor',
           'email'=>'required|unique:users,email,'.$id,
           'password'=>'sometimes|nullable|min:6',
      ],[],[
        'name' => trans('admin.name'),
        'email' => trans('admin.email'),
        'password' => trans('admin.password'),
      ]);
      if(request()->has('password')) {
         $data['password'] =bcrypt(request('password'));
    }
     User::where('id',$id)->update($data);
      session()->flash('success',trans('admin.record_updated'));
      return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      User::find($id)->delete();
      session()->flash('success',trans('admin.record_deleted'));
     return redirect('admin/users');
    }




    // delete multiple items

    public function multiple_delete(){

       // item array that i receive in admin.btn.check.blade.php
         if(is_array(request('item'))) {
             User::destroy(request('item'));
         }else{
           User::find(request('item'))->delete();

         }

         session()->flash('success',trans('admin.record_deleted'));
         return redirect('admin/users');
    }

}  // end class
