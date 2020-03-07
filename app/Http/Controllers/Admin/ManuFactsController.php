<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\ManuFactsDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ManuFact;
use Up;
use Storage;
class ManuFactsController extends Controller
 {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function index(ManuFactsDatatable $fact)
    {
        return $fact->render('admin.cities.index',['title'=>'City controller',]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufacts.create',['title'=>trans("admin.add"),]);
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
        ]);


        if(request()->hasFile('icon')) {



              $data['icon'] = UP::upload([
                'file' =>   'icon', // file name
                'upload_type' => 'single',
                'path'        => 'manufacts',  // folder path to to store image
                'delete_file'=>'',
              ]);

        }

        ManuFact::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('manufacts'));
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
        $manufacts = ManuFact::find($id);
        $title = trans('admin.edit');
        return view('admin.manufacts.edit',compact('title','manufacts'));
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
      ]);


      if(request()->hasFile('icon')) {



            $data['icon'] = UP::upload([
              'file' =>   'icon', // file name
              'upload_type' => 'single',
              'path'        => 'manufacts',  // folder path to to store image
              'delete_file'=>ManuFact::find($id)->icon,
            ]);

      }



         ManuFact::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('manufacts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    public function destroy($id)
    {

      $manufacts = ManuFact::find($id);
      Storage::delete($manufacts->logo);
      $manufacts->delete();
      session()->flash('success',trans('admin.deleted_record'));
      return redirect(aurl('manufacts'));
    }




    // delete multiple items

    public function multiple_delete(){

      // item array that i receive in admin.btn.check.blade.php
        if(is_array(request('item'))) {
           foreach (request('item') as $id) {
             $manufacts = ManuFact::find($id);
             Storage::delete($manufacts->logo);
             $manufacts->delete();
           }
        }else{

            $manufacts = ManuFact::find($id);
            Storage::delete($manufacts->logo);
            $manufacts->delete();

        }

        session()->flash('success',trans('admin.record_deleted'));
        return redirect(aurl('manufacts'));
    }


}  // end class
