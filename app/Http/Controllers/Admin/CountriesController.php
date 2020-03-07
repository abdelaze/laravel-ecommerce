<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\CountryDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Country;
use Up;
use Storage;
class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function index(CountryDatatable $admin)
    {
        return $admin->render('admin.countries.index',['title'=>'Country controller',]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.countries.create',['title'=>trans("admin.admin_create"),]);
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
             'country_name_ar' =>'required',
             'country_name_en' =>'required',
             'mob' =>'required',
             'code' =>'required',
             'currency' =>'required',
             'logo' =>'sometimes|nullable|'.validate_img(),

        ],[],[
          'country_name_ar' => trans('admin.country_name_ar'),
          'country_name_ar' => trans('admin.country_name_ar'),
          'mob' => trans('admin.mob'),
          'code' => trans('admin.code'),
          'currency' => trans('admin.currency'),
          'logo' => trans('admin.logo'),

        ]);

        if(request()->hasFile('logo')) {



              $data['logo'] = UP::upload([
                'file' =>   'logo', // file name
                'upload_type' => 'single',
                'path'        => 'countries',  // folder path to to store image
                'delete_file'=>'',
              ]);

        }

        Country::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('countries'));
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
        $country = Country::find($id);
        $title = trans('admin.edit');
        return view('admin.countries.edit',compact('title','country'));
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
           'country_name_ar' =>'required',
           'country_name_en' =>'required',
           'mob' =>'required',
           'code' =>'required',
           'currency' =>'required',
           'logo' =>'sometimes|nullable|'.validate_img(),

      ],[],[
        'country_name_ar' => trans('admin.country_name_ar'),
        'country_name_ar' => trans('admin.country_name_ar'),
        'mob' => trans('admin.mob'),
        'code' => trans('admin.code'),
        'currency' => trans('admin.currency'),
        'logo' => trans('admin.logo'),
      ]);

      if(request()->hasFile('logo')) {


           $data['logo'] = UP::upload([
              'file' =>   'logo', // file name
              'upload_type' => 'single',
              'delete_file' => Country::find($id)->logo,
              'path'        => 'countries',  // folder path to to store image
            ]);

      }


         Country::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('countries'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $country = Country::find($id);
      Storage::delete($country->logo);
      $country->delete();
      session()->flash('success',trans('admin.deleted_record'));
      return redirect(aurl('countries'));
    }




    // delete multiple items

    public function multiple_delete(){

       // item array that i receive in admin.btn.check.blade.php
         if(is_array(request('item'))) {
            foreach (request('item') as $id) {
              $country = Country::find($id);
              Storage::delete($country->logo);
              $country->delete();
            }
         }else{

             $country = Country::find($id);
             Storage::delete($country->logo);
             $country->delete();

         }

         session()->flash('success',trans('admin.record_deleted'));
         return redirect(aurl('countries'));
    }

}  // end class
