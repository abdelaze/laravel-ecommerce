<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\MallsDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Mall;
use Up;
use Storage;
class MallsController extends Controller
 {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function index(MallsDatatable $mall)
    {
        return $mall->render('admin.malls.index',['title'=>trans('admin.malls'),]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.malls.create',['title'=>trans("admin.add"),]);
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
             'mobile'  =>'required|numeric',
              'email'  =>'required|email',
              'address'   =>'sometimes|nullable',
              'facebook'   =>'sometimes|nullable|url',
              'twitter'   =>'sometimes|nullable|url',
              'website'   =>'sometimes|nullable|url',
              'connect_name'   =>'sometimes|nullable|string',  // المسئول عن المصنع
              'lat'   =>'sometimes|nullable',
              'lng'   =>'sometimes|nullable',
              'icon'   =>'sometimes|nullable|'.validate_img(),
              'country_id'   =>'required|numeric',



        ],[],[
          'name_ar' => trans('admin.name_ar'),
          'name_en' => trans('admin.name_en'),
          'facebook' => trans('admin.facebook'),
          'twitter' => trans('admin.twitter'),
          'website' => trans('admin.website'),
          'connect_name' => trans('admin.connect_name'),
          'lat' => trans('admin.lat'),
          'lng' => trans('admin.lng'),
          'icon' => trans('admin.icon'),
          'mobile' => trans('admin.mobile'),
          'email' => trans('admin.email'),
           'address' => trans('admin.address'),
           'country_id' => trans('admin.country_id'),
        ]);


        if(request()->hasFile('icon')) {



              $data['icon'] = UP::upload([
                'file' =>   'icon', // file name
                'upload_type' => 'single',
                'path'        => 'malls',  // folder path to to store image
                'delete_file'=>'',
              ]);

        }

        Mall::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('malls'));
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
        $mall = Mall::find($id);
        $title = trans('admin.edit');
        return view('admin.malls.edit',compact('title','mall'));
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
           'mobile'  =>'required|numeric',
            'email'  =>'required|email',
            'address'   =>'sometimes|nullable',
            'facebook'   =>'sometimes|nullable|url',
            'twitter'   =>'sometimes|nullable|url',
            'website'   =>'sometimes|nullable|url',
            'connect_name'   =>'sometimes|nullable|string',  // المسئول عن المصنع
            'lat'   =>'sometimes|nullable',
            'lng'   =>'sometimes|nullable',
            'icon'   =>'sometimes|nullable|'.validate_img(),
            'country_id'   =>'required|numeric',

      ],[],[
        'name_ar' => trans('admin.name_ar'),
        'name_en' => trans('admin.name_en'),
        'facebook' => trans('admin.facebook'),
        'twitter' => trans('admin.twitter'),
        'website' => trans('admin.website'),
        'connect_name' => trans('admin.connect_name'),
        'lat' => trans('admin.lat'),
        'lng' => trans('admin.lng'),
        'icon' => trans('admin.icon'),
        'mobile' => trans('admin.mobile'),
        'email' => trans('admin.email'),
        'address'   =>trans('admin.address'),
        'country_id' => trans('admin.country_id'),
      ]);


      if(request()->hasFile('icon')) {



            $data['icon'] = UP::upload([
              'file' =>   'icon', // file name
              'upload_type' => 'single',
              'path'        => 'malls',  // folder path to to store image
              'delete_file'=>Mall::find($id)->icon,
            ]);

      }



         Mall::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('malls'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    public function destroy($id)
    {

      $mall = Mall::find($id);
      Storage::delete($mall->logo);
      $mall->delete();
      session()->flash('success',trans('admin.deleted_record'));
      return redirect(aurl('malls'));
    }




    // delete multiple items

    public function multiple_delete(){

      // item array that i receive in admin.btn.check.blade.php
        if(is_array(request('item'))) {
           foreach (request('item') as $id) {
             $malls = Mall::find($id);
             Storage::delete($malls->logo);
             $malls->delete();
           }
        }else{

            $malls = Mall::find($id);
            Storage::delete($malls->logo);
            $malls->delete();

        }

        session()->flash('success',trans('admin.record_deleted'));
        return redirect(aurl('malls'));
    }


}  // end class
