<?php
// This Method Used To Return All Data About The Project

if (!function_exists('setting')) {
	function setting() {
		return \App\Model\Setting::orderBy('id', 'desc')->first();
	}
}



if(!function_exists('aurl')) {

     function aurl($url=null) {
       return url('admin/'.$url);
    }
}

// function for return all categories
if(!function_exists('load_dep')) {

    function load_dep($select = null ,$dep_hide = null) {
       $departments = \App\Model\Department::selectRaw('dep_name_'.session('lang').' as text')
			 ->selectRaw('id as id')
			 ->selectRaw('parent as parent')
			 ->get(['text','id','parent']);
			 $dep_arr = [];
			 foreach ($departments as $department) {
			 	    $list_arr = [];
						$list_arr['icon'] = '';
						 $list_arr['children'] =[];
						 $list_arr['li_attr'] =[];
						 $list_arr['a_attr'] =[];
						if($select !==null and $select == $department->id) {

							 $list_arr['state'] = [
								   'opened'    => true , // is the node open
	                 'selected'    => true, // is the node selected
									  'disabled'   =>false,
                    'hidden'     =>false,
							 ];


						}

						if($dep_hide !==null and $dep_hide == $department->id) {

							 $list_arr['state'] = [
									 'opened'    => false , // is the node open
									 'selected'    => false, // is the node selected
										'disabled'   =>true,
										'hidden'     =>true,

							 ];


						}


             $list_arr['id'] = $department->id;
						 $list_arr['text'] = $department->text;
						 $list_arr['parent'] = $department->parent >0 ? $department->parent : "#";
						array_push($dep_arr,$list_arr);
			 }

      return json_encode($dep_arr,JSON_UNESCAPED_UNICODE);
    }




}



// function for admin guard
if(!function_exists('admin')) {

    function admin() {
        return Auth::guard('admin');
    }

}

// function for active the link which i click in it and make refresh for the page automatic we will use amethod for compare call preg_match and well return aclass and style
if(!function_exists('active_menu')) {

    function active_menu($link) {
      if(preg_match('/'.$link.'/i',Request::segment(2))) {  //segment(2) mean the index 2 of the link

           return ['menu_open','display:block'];
      } else {
          return['',''];
      }
    }

}

// function for return language
if(!function_exists('lang')) {

    function lang() {

        if(session()->has('lang')){

          return session('lang');

        }else {
					session()->put('lang',setting()->main_lang);
          return setting()->main_lang;
        }
    }

}

// function for return direction of css file
if(!function_exists('direction')) {

    function direction() {

        if(session()->has('lang')){

            if(session('lang') == 'ar') {
               return 'rtl';
            }
            else {
               return 'ltr';
            }

        } else {
           return 'ltr';
        }

}

}


// This Helper function for only words in datatables

if(!function_exists('datatableLanguage')) {

  function datatableLanguage() {


    return  [
                 "sEmptyTable" => trans('admin.sEmptyTable'),
                 "sInfo"     => trans('admin.sInfo'),
                 "sInfoEmpty"   => trans('admin.sInfoEmpty'),
                 "sInfoFiltered" => trans('admin.sInfoFiltered'),
                 "sInfoPostFix"    => trans('admin.sInfoPostFix'),
                 "sInfoThousands"  => trans('admin.sInfoThousands'),
                 "sLengthMenu"   => trans('admin.sLengthMenu'),
                 "sLoadingRecords"=> trans('admin.sLoadingRecords'),
                 "sProcessing"=> trans('admin.sProcessing'),
                 "sSearch"=> trans('admin.sSearch'),
                 "sZeroRecords"=> trans('admin.sZeroRecords'),
                 "oPaginate"=> [
                   "sFirst"=> trans('admin.oPaginate.sFirst'),
                   "sLast"=> trans('admin.oPaginate.sLast'),
                   "sNext"=> trans('admin.oPaginate.sNext'),
                   "sPrevious"=> trans('admin.oPaginate.sPrevious'),
                 ],
                 "oAria" =>[
                   "sSortAscending" => trans('admin.sSortAscending'),
                   "sSortDescending" => trans('admin.sSortDescending'),
                 ],


          ];


}

}


// This Function to validate Image
if(!function_exists('validate_img')) {

   function validate_img ($ext = null ){

			   if($ext ===null) {
					  return 'image|mimes:jpg,jpeg,png,gif,bmp';
				 }else {
					  return 'image|mimes:'.$ext; // i can indicate the ext which i will compare using it
				 }
	 }

}

// This Function to validate Image
