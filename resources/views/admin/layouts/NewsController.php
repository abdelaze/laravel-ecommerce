<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;
use App\User;
use App\Comment;
use CHECKEXISTSNEWS;

class NewsController extends Controller {
   public function all_news(){
      $all_news = News::withCount('comments')->orderBy('id','desc')->paginate(1);
      return response(['news'=>$all_news]);
   }

   public function news($id) {
       $news = News::find($id);
       $comments = $news->comments()->paginate(2);
       return !empty($news) ?  response(['status'=> true ,compact('news','comments')]) : response(['status'=>false]);
     }

    public function add_comment(){
      $rules = [
        'comment'=>  'required',
        'news_id'=> ['required','numeric',new CHECKEXISTSNEWS],
      ];
      $validate_data = Validator::make(request()->all(),$rules);
           if($validate_data->fails()) {
               return response(['status'=>false,'messages'=>$validate_data->messages]);
           }else {
              $data =request()->except('api_token');
              $data['user_id'] = auth()->user()->id;
              Comment::create($data);
              return response(['status'=>true,'messages'=>'comment is added']);
           }
    }
}
