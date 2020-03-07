@extends('admin.index')
@section('content')


<div class="box">

          <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
          </div>
          <!-- /.box-header -->
      <div class="box-body">

            {!!Form::open(['route'=>['colors.update',$color->id],'method'=>'put'])!!}

            {!!Form::open(['route'=>'colors.store','files'=>'true',])!!}


                 <div class="form-group">
                   {!!Form::label('name_ar',trans('admin.name_ar'))!!}
                  {!!Form::text('name_ar',$color->name_ar,['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                   {!!Form::label('name_en',trans('admin.name_en'))!!}
                  {!!Form::text('name_en',$color->name_en,['class'=>'form-control'])!!}
                 </div>

                 <div class="form-group">
                   {!!Form::label('color',trans('admin.color'))!!}
                  {!!Form::color('color',$color->color,['class'=>'form-control'])!!}
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
