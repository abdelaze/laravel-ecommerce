<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
class Upload extends Controller
{

   // The Parametrs I will Put It In Array

   /*

      parameter[

         'file'  = the name of the field for image in table for examle logo
         'path' = The Folder Who i will put the images in it,
         'delete_file'  = the name of the image which i willl delete during updating
         'new_name'   = if iwant to stroe the image with different name i will choice  it by my self

    ]




   */

  // static  to call it using class
    public static function upload($data = []){

       if(in_array('new_name',$data)) {
          $new_name = $new_name == null ? time() :  $data['new_name'];

       }
       if(request()->hasFile($data['file'])  && $data['upload_type'] == 'single' ) {
           Storage::has($data['delete_file']) ?  Storage::delete($data['delete_file']):'';
          return  request()->file($data['file'])->store($data['path']);
       }

    }

} // end function
