<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\ShippingDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Shipping;
use Up;
use Storage;
class ShippingController extends Controller
 {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function index(ShippingDatatable $ship)
    {
        return $ship->render('admin.Shipping.index',['title'=>trans('admin.shipping'),]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Shipping.create',['title'=>trans("admin.add"),]);
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
             'user_id'  =>'required|numeric',
              'lat'   =>'sometimes|nullable',
              'lng'   =>'sometimes|nullable',
              'icon'   =>'sometimes|nullable|'.validate_img(),


        ],[],[
          'name_ar' => trans('admin.name_ar'),
          'name_en' => trans('admin.name_en'),
          'user_id' => trans('admin.owner_id'),
          'lat' => trans('admin.lat'),
          'lng' => trans('admin.lng'),
          'icon' => trans('admin.icon'),

        ]);


        if(request()->hasFile('icon')) {



              $data['icon'] = UP::upload([
                'file' =>   'icon', // file name
                'upload_type' => 'single',
                'path'        => 'shippings',  // folder path to to store image
                'delete_file'=>'',
              ]);

        }

        Shipping::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('shipping'));
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
        $shipping = Shipping::find($id);
        $title = trans('admin.edit');
        return view('admin.shipping.edit',compact('title','shipping'));
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
           'user_id'  =>'required|numeric',
            'lat'   =>'sometimes|nullable',
            'lng'   =>'sometimes|nullable',
            'icon'   =>'sometimes|nullable|'.validate_img(),


      ],[],[
        'name_ar' => trans('admin.name_ar'),
        'name_en' => trans('admin.name_en'),
        'user_id' => trans('admin.owner_id'),
        'lat' => trans('admin.lat'),
        'lng' => trans('admin.lng'),
        'icon' => trans('admin.icon'),

      ]);

      if(request()->hasFile('icon')) {



            $data['icon'] = UP::upload([
              'file' =>   'icon', // file name
              'upload_type' => 'single',
              'path'        => 'shippings',  // folder path to to store image
              'delete_file'=>Shipping::find($id)->icon,
            ]);

      }



        Shipping::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('shipping'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    public function destroy($id)
    {

      $shipping = Shipping::find($id);
      Storage::delete($shipping->icon);
      $shipping->delete();
      session()->flash('success',trans('admin.deleted_record'));
      return redirect(aurl('shipping'));
    }




    // delete multiple items

    public function multiple_delete(){

      // item array that i receive in admin.btn.check.blade.php
        if(is_array(request('item'))) {
           foreach (request('item') as $id) {
             $shippings = Shipping::find($id);
             Storage::delete($shippings->logo);
             $shippings->delete();
           }
        }else{

            $shippings = Shipping::find($id);
            Storage::delete($shippings->logo);
            $shippings->delete();

        }

        session()->flash('success',trans('admin.record_deleted'));
        return redirect(aurl('shipping'));
    }


}  // end class
