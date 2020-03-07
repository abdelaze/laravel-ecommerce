@extends('admin.index')
@section('content')

<div class="box">

          <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
          </div>
          <!-- /.box-header -->
      <div class="box-body">

            {!!Form::open(['route'=>'users.store'])!!}

                 <div class="form-group">
                   {!!Form::label('name',trans('admin.name'))!!}
                  {!!Form::text('name',old('name'),['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                   {!!Form::label('email',trans('admin.email'))!!}
                  {!!Form::email('email',old('email'),['class'=>'form-control'])!!}
                 </div>

                 <div class="form-group">
                   {!!Form::label('password',trans('admin.password'))!!}
                  {!!Form::password('password',['class'=>'form-control'])!!}
                 </div>

                 <div class="form-group">
                   {!!Form::label('level',trans('admin.level'))!!}
                  {!!Form::select('level',['user'=>trans("admin.user"),'company'=>trans("admin.company"),'vendor'=>trans("admin.vendor")],old('level'),['class'=>'form-control','placeholder'=>'............'])!!}
                 </div>

                 <div class="form-group">

                    {!!Form::submit(trans('admin.create'),['class'=>'btn btn-primary'])!!}
                  </div>

            {!!Form::close()!!}
    </div>
          <!-- /.box-body -->
</div>
        <!-- /.box -->



@endsection
