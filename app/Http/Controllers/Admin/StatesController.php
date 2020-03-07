<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\StateDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\State;
use Up;
use Storage;
use App\Model\City;
use Form;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function index(StateDatatable $state)
    {
        return $state->render('admin.states.index',['title'=>'State controller',]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(request()->ajax()) {

            if(request()->has('country_id')) {
               $select = request()->has('select') ? request('select') : '';
               return Form::select('city_id',City::where('country_id',request('country_id'))->pluck('city_name_'.session('lang'),'id'),$select,['class'=>'form-control','placeholder'=>'.............']);
            }
        }

        return view('admin.states.create',['title'=>trans("admin.add"),]);
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
             'state_name_ar' =>'required',
             'state_name_en' =>'required',
             'country_id'   =>'required|numeric',
             'city_id'   =>'required|numeric',

        ],[],[
          'state_name_ar' => trans('admin.state_name_ar'),
          'state_name_ar' => trans('admin.state_name_ar'),
          'country_id' => trans('admin.country_id'),
          'city_id' => trans('admin.city_id'),
        ]);



        State::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('states'));
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
        $state = State::find($id);
        $title = trans('admin.edit');
        return view('admin.states.edit',compact('title','state'));
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
           'state_name_ar' =>'required',
           'state_name_en' =>'required',
           'country_id'   =>'required|numeric',
           'city_id'   =>'required|numeric',

      ],[],[
        'city_name_ar' => trans('admin.city_name_ar'),
        'city_name_ar' => trans('admin.city_name_ar'),
        'country_id' => trans('admin.country_id'),
        'city_id' => trans('admin.city_id'),
      ]);




         State::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('states'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $state = State::find($id);

      $state->delete();
      session()->flash('success',trans('admin.deleted_record'));
      return redirect(aurl('states'));
    }




    // delete multiple items

    public function multiple_delete(){

       // item array that i receive in admin.btn.check.blade.php
       if(is_array(request('item'))) {
           State::destroy(request('item'));
       }else{
         State::find(request('item'))->delete();

       }


         session()->flash('success',trans('admin.record_deleted'));
         return redirect(aurl('states'));
    }


}  // end class
