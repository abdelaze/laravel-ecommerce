<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\AdminDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function index(AdminDatatable $admin)
    {
        return $admin->render('admin.admins.index',['title'=>'Admin controller',]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create',['title'=>trans("admin.admin_create"),]);
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
             'email'=>'required|unique:admins',
             'password'=>'required|min:6',
        ],[],[
          'name' => trans('admin.name'),
          'email' => trans('admin.email'),
          'password' => trans('admin.password'),
        ]);

        $data['password'] =bcrypt(request('password'));
        Admin::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect('admin/admin');
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
        $admin = Admin::find($id);
        $title = trans('admin.edit_admin');
        return view('admin.admins.edit',compact('title','admin'));
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
           'email'=>'required|unique:admins,email,'.$id,
           'password'=>'sometimes|nullable|min:6',
      ],[],[
        'name' => trans('admin.name'),
        'email' => trans('admin.email'),
        'password' => trans('admin.password'),
      ]);
      if(request()->has('password')) {
         $data['password'] =bcrypt(request('password'));
    }

         Admin::where('id',$id)->update($data);
      session()->flash('success',trans('admin.record_updated'));
      return redirect('admin/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Admin::find($id)->delete();
      session()->flash('success',trans('admin.record_deleted'));
     return redirect('admin/admin');
    }




    // delete multiple items

    public function multiple_delete(){

       // item array that i receive in admin.btn.check.blade.php
         if(is_array(request('item'))) {
             Admin::destroy(request('item'));
         }else{
           Admin::find(request('item'))->delete();

         }

         session()->flash('success',trans('admin.record_deleted'));
         return redirect('admin/admin');
    }

}  // end class
