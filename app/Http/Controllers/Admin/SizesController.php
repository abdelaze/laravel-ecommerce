<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\SizesDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Size;
use Up;
use Storage;
class SizesController extends Controller
 {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function index(SizesDatatable $color)
    {
        return $color->render('admin.sizes.index',['title'=>trans('admin.sizes'),]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sizes.create',['title'=>trans("admin.add"),]);
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
             'name_ar' =>'required',
             'name_en' =>'required',
             'is_public'  =>'required|in:yes,no',
             'department_id' =>'required|numeric',




        ],[],[
          'name_ar' => trans('admin.name_ar'),
          'name_en' => trans('admin.name_en'),
          'is_public' => trans('admin.is_public'),
          'department_id' => trans('admin.department_id'),
        ]);




        Size::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('sizes'));
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
        $size = Size::find($id);
        $title = trans('admin.edit');
        return view('admin.sizes.edit',compact('title','size'));
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
           'name_ar' =>'required',
           'name_en' =>'required',
           'is_public'  =>'required|in:yes,no',
           'department_id' =>'required|numeric',


      ],[],[
        'name_ar' => trans('admin.name_ar'),
        'name_en' => trans('admin.name_en'),
        'is_public' => trans('admin.is_public'),
        'department_id' => trans('admin.department_id'),

      ]);






         Size::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('sizes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    public function destroy($id)
    {

      $size = Size::find($id);

      $size->delete();
      session()->flash('success',trans('admin.deleted_record'));
      return redirect(aurl('sizes'));
    }




    // delete multiple items

    public function multiple_delete(){

      // item array that i receive in admin.btn.check.blade.php
        if(is_array(request('item'))) {
           foreach (request('item') as $id) {
             $sizes = Size::find($id);
             $sizes->delete();
           }
        }else{

            $sizes = Color::find($id);

            $sizes->delete();

        }

        session()->flash('success',trans('admin.record_deleted'));
        return redirect(aurl('sizes'));
    }


}  // end class
