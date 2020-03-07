@extends('admin.index')
@section('content')

<div class="box">

          <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
          </div>
          <!-- /.box-header -->
      <div class="box-body">

            {!!Form::open(['route'=>['trademarks.update',$trademarks->id],'method'=>'put','files'=>'true'])!!}

            <div class="form-group">
              {!!Form::label('name_ar',trans('admin.name_ar'))!!}
             {!!Form::text('name_ar',$trademarks->name_ar,['class'=>'form-control'])!!}
            </div>
            <div class="form-group">
              {!!Form::label('name_en',trans('admin.name_en'))!!}
             {!!Form::text('name_en',$trademarks->name_en,['class'=>'form-control'])!!}
            </div>


            <div class="form-group">
              {!!Form::label('logo',trans('admin.trade_logo'))!!}
              {!!Form::file('logo',['class'=>'form-control'])!!}
               <img src="{{Storage::url($trademarks->logo)}}" style="width:100px;height:100px;">
            </div>

                 <div class="form-group">

                    {!!Form::submit(trans('admin.save'),['class'=>'btn btn-success'])!!}
                  </div>

            {!!Form::close()!!}
    </div>
          <!-- /.box-body -->
</div>
        <!-- /.box -->



@endsection
