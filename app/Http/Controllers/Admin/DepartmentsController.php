<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Department;
use Up;
use Storage;
class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function index()
    {
        return view('admin.departments.index',['title'=>trans("admin.departments"),]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departments.create',['title'=>trans("admin.add"),]);
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
             'dep_name_ar' =>'required',
             'dep_name_en' =>'required',
              'icon'   =>'sometimes|nullable|'.validate_img(),
              'descrption'   =>'sometimes|nullable',
              'keyword'   =>'sometimes|nullable',
              'parent'   =>'sometimes|nullable',

        ],[],[
          'dep_name_ar' => trans('admin.dep_name_ar'),
          'dep_name_en' => trans('admin.dep_name_en'),
          'icon' => trans('admin.icon'),
          'description' => trans('admin.description'),
          'keyword' => trans('admin.keyword'),
          'parent' => trans('admin.parent_id'),
        ]);


        if(request()->hasFile('icon')) {



              $data['icon'] = UP::upload([
                'file' =>   'logo', // file name
                'upload_type' => 'single',
                'path'        => 'departments',  // folder path to to store image
                'delete_file'=>'',
              ]);

        }

        Department::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('departments'));
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
        $department = Department::find($id);
        $title = trans('admin.edit');
        return view('admin.departments.edit',compact('title','department'));
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
            'dep_name_ar' =>'required',
            'dep_name_en' =>'required',
            'icon'   =>'sometimes|nullable|'.validate_img(),
            'desciption'   =>'sometimes|nullable',
            'keyword'   =>'sometimes|nullable',
            'parent'   =>'sometimes|nullable',

      ],[],[
        'dep_name_ar' => trans('admin.dep_name_ar'),
        'dep_name_en' => trans('admin.dep_name_en'),
        'icon' => trans('admin.icon'),
        'description' => trans('admin.description'),
        'keyword' => trans('admin.keyword'),
        'parent' => trans('admin.parent_id'),
      ]);


      if(request()->hasFile('icon')) {


           $data['icon'] = UP::upload([
              'file' =>   'icon', // file name
              'upload_type' => 'single',
              'delete_file' => Department::find($id)->icon,
              'path'        => 'departments',  // folder path to to store image
            ]);

      }



         Department::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('departments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

   // find the childs of the dep and delete them and then delete this dep
    public static function delete_parent($id){

       $departments = Department::where('parent','id')->get();

       foreach ($departments as  $sub_dep) {

               self::delete_parent($sub_dep->id);
               if(!empty($sub_dep->icon)) {
                  $sub_icon  = $sub_dep->icon;
                  Storage::has($sub_icon) ?  Storage::delete($sub_icon):'';
               }
               $sub = Department::find($sub_dep->id);
                   if(!empty($sub)) {
                   $sub->delete();
                 }

            }

              $department = Department::find($id);

              if(!empty($department->icon)) {

                 Storage::has($department->icon) ?  Storage::delete($department->icon):'';

              }

              $department->delete();

    }


    public function destroy($id)
    {

     self::delete_parent($id);

      session()->flash('success',trans('admin.deleted_record'));
      return redirect(aurl('departments'));
    }




    // delete multiple items

    public function multiple_delete(){

       // item array that i receive in admin.btn.check.blade.php
       if(is_array(request('item'))) {
           Department::destroy(request('item'));
       }else{
         Department::find(request('item'))->delete();

       }


         session()->flash('success',trans('admin.record_deleted'));
         return redirect(aurl('departments'));
    }


}  // end class
