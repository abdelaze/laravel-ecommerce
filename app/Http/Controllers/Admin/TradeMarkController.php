<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\TradeMarkDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TradeMark;
use Up;
use Storage;
class TradeMarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function index(TradeMarkDatatable $trade)
    {
        return $trade->render('admin.trademarks.index',['title'=>trans('admin.trademarks'),]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trademarks.create',['title'=>trans("admin.trade_create"),]);
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
             'logo' =>'sometimes|nullable|'.validate_img(),

        ],[],[
          'name_ar' => trans('admin.name_ar'),
          'name_ar' => trans('admin.name_ar'),
          'logo' => trans('admin.trade_logo'),

        ]);

        if(request()->hasFile('logo')) {



              $data['logo'] = UP::upload([
                'file' =>   'logo', // file name
                'upload_type' => 'single',
                'path'        => 'trademarks',  // folder path to to store image
                'delete_file'=>'',
              ]);

        }

        TradeMark::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('trademarks'));
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
        $trademarks = TradeMark::find($id);
        $title = trans('admin.edit');
        return view('admin.trademarks.edit',compact('title','trademarks'));
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
           'logo' =>'sometimes|nullable|'.validate_img(),

      ],[],[
        'name_ar' => trans('admin.name_ar'),
        'name_ar' => trans('admin.name_ar'),
        'logo' => trans('admin.trade_logo'),

      ]);

      if(request()->hasFile('logo')) {



            $data['logo'] = UP::upload([
              'file' =>   'logo', // file name
              'upload_type' => 'single',
              'path'        => 'trademarks',  // folder path to to store image
              'delete_file'=>TradeMark::find($id)->logo,
            ]);

      }


          TradeMark::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('trademarks'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $trademark = TradeMark::find($id);
      Storage::delete($trademark->logo);
      $trademark->delete();
      session()->flash('success',trans('admin.deleted_record'));
      return redirect(aurl('trademarks'));
    }




    // delete multiple items

    public function multiple_delete(){

       // item array that i receive in admin.btn.check.blade.php
         if(is_array(request('item'))) {
            foreach (request('item') as $id) {
              $trademarks = TradeMark::find($id);
              Storage::delete($trademarks->logo);
              $trademarks->delete();
            }
         }else{

             $trademarks = TradeMark::find($id);
             Storage::delete($trademarks->logo);
             $trademarks->delete();

         }

         session()->flash('success',trans('admin.record_deleted'));
         return redirect(aurl('trademarks'));
    }

}  // end class
