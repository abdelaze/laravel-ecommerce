<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Setting;
use Storage;
use Up; // i put it in aliases
class Settings extends Controller {

	public function setting() {
		return view('admin.settings', ['title' => trans('admin.settings')]);
	}

	public function setting_save() {
		$data = $this->validate(request(),[
			  'logo' => validate_img(),
				'icon' => validate_img(),
		],[],[
			 'logo' => trans('admin.logo'),
			 'icon' => trans('admin.icon'),
		]);
		$data = request()->except(['_token', '_method']);
		if(request()->hasFile('logo')) {



          $data['logo'] = UP::upload([
						'file' =>   'logo', // file name
						'upload_type' => 'single',
						'delete_file' => setting()->logo, // name of the image  from database
						'path'        => 'settings',  // folder path to to store image
					]);

		}
		if(request()->hasFile('icon')) {

			$data['icon'] = UP::upload([
				'file' =>   'icon', // file name
				'upload_type' => 'single',
				'delete_file' => setting()->icon, // name of the image  from database
				'path'        => 'settings',  // folder path to to store image
			]);

		}
		Setting::orderBy('id', 'desc')->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('settings'));
	}
}
