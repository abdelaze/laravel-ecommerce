@extends('admin.index')
@section('content')


@push('js')

  <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCckEBW0NxXoTcd3_FYSPDbfafzlJUd7FU&v=3&callback=init_MY_Map&libraries=places'></script>



<script src="{{url('design/admin')}}/dist/js/locationpicker.jquery.js"></script>

<?php

    $lat= !empty($manufacts->lat) ? $manufacts->lat :  '30.0444';
    $lng= !empty($manufacts->lng) ? $manufacts->lng :  '31.2357';

?>
<script>
         $('#us1').locationpicker({
             location: {
                 latitude: {{$lat}},
                 longitude: {{$lng}},
             },
             radius: 300,
             markerIcon: '{{url("design/admin/dist/img/map.png")}}',

             inputBinding: {

                    //  locationNameInput: $('#address'),
                      latitudeInput: $('#lat'),
                      longitudeInput: $('#lng'),


               },
         });

</script>
@endpush
<div class="box">

          <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
          </div>
          <!-- /.box-header -->
      <div class="box-body">

            {!!Form::open(['route'=>['shipping.update',$shipping->id],'method'=>'put','files'=>'true'])!!}

            {!!Form::open(['route'=>'shipping.store','files'=>'true',])!!}

               <input type="hidden" value="{{$lat}}" id="lat" name="lat">
               <input type="hidden" value="{{$lng}}" id="lng" name="lng">
                 <div class="form-group">
                   {!!Form::label('name_ar',trans('admin.name_ar'))!!}
                  {!!Form::text('name_ar',$shipping->name_ar,['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                   {!!Form::label('name_en',trans('admin.name_en'))!!}
                  {!!Form::text('name_en',$shipping->name_en,['class'=>'form-control'])!!}
                 </div>

                 <div class="form-group">

                   {!!Form::label('user_id',trans('admin.owner_id'))!!}
                  {!!Form::select('user_id',App\User::where('level','company')->pluck('name','id'), $shipping->user_id,['class'=>'form-control'])!!}
                 </div>




                    <div class="form-group">

                         <div id="us1" style="width: 100%; height: 400px;"></div>

                  </div>



                 <div class="form-group">
                   {!!Form::label('icon',trans('admin.fact_icon'))!!}
                   {!!Form::file('icon',['class'=>'form-control'])!!}
                   @if(!empty($manufacts->icon))
                    <img src="{{Storage::url($manufacts->icon)}}" style="width:100px;height:100px;">
                  @endif

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
