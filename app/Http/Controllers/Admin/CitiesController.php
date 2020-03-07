<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\CityDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\City;
use Up;
use Storage;
class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function index(CityDatatable $admin)
    {
        return $admin->render('admin.cities.index',['title'=>'City controller',]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.create',['title'=>trans("admin.add"),]);
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
             'city_name_ar' =>'required',
             'city_name_en' =>'required',
              'country_id'   =>'required|numeric',

        ],[],[
          'city_name_ar' => trans('admin.city_name_ar'),
          'city_name_ar' => trans('admin.city_name_ar'),
          'country_id' => trans('admin.country_id'),
        ]);



        City::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('cities'));
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
        $city = City::find($id);
        $title = trans('admin.edit');
        return view('admin.cities.edit',compact('title','city'));
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
           'city_name_ar' =>'required',
           'city_name_en' =>'required',
            'country_id'   =>'required|numeric',

      ],[],[
        'city_name_ar' => trans('admin.city_name_ar'),
        'city_name_ar' => trans('admin.city_name_ar'),
        'country_id' => trans('admin.country_id'),
      ]);





         City::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('cities'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $city = City::find($id);

      $city->delete();
      session()->flash('success',trans('admin.deleted_record'));
      return redirect(aurl('cities'));
    }




    // delete multiple items

    public function multiple_delete(){

       // item array that i receive in admin.btn.check.blade.php
       if(is_array(request('item'))) {
           City::destroy(request('item'));
       }else{
         City::find(request('item'))->delete();

       }


         session()->flash('success',trans('admin.record_deleted'));
         return redirect(aurl('cities'));
    }


}  // end class
