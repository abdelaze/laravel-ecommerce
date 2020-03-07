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

                      locationNameInput: $('#address'),
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

            {!!Form::open(['route'=>['manufacts.update',$manufacts->id],'method'=>'put','files'=>'true'])!!}

            {!!Form::open(['route'=>'manufacts.store','files'=>'true',])!!}

               <input type="hidden" value="{{$lat}}" id="lat" name="lat">
               <input type="hidden" value="{{$lng}}" id="lng" name="lng">
                 <div class="form-group">
                   {!!Form::label('name_ar',trans('admin.name_ar'))!!}
                  {!!Form::text('name_ar',$manufacts->name_ar,['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                   {!!Form::label('name_en',trans('admin.name_en'))!!}
                  {!!Form::text('name_en',$manufacts->name_en,['class'=>'form-control'])!!}
                 </div>

                 <div class="form-group">
                   {!!Form::label('connect_name',trans('admin.connect_name'))!!}
                  {!!Form::text('connect_name',$manufacts->connect_name,['class'=>'form-control'])!!}
                 </div>

                 <div class="form-group">
                   {!!Form::label('mobile',trans('admin.mobile'))!!}
                  {!!Form::text('mobile',$manufacts->mobile,['class'=>'form-control'])!!}
                 </div>

                 <div class="form-group">
                   {!!Form::label('email',trans('admin.email'))!!}
                  {!!Form::email('email',$manufacts->email,['class'=>'form-control'])!!}
                 </div>


                 <div class="form-group">
                 {!!Form::label('address',trans('admin.address'))!!}
                  {!!Form::text('address',$manufacts->address,['class'=>'form-control address'])!!}

                 </div>

                 <div class="form-group">

                         <div id="us1" style="width: 100%; height: 400px;"></div>

                  </div>



                 <div class="form-group">
                   {!!Form::label('facebook',trans('admin.facebook'))!!}
                  {!!Form::text('facebook',$manufacts->facebook,['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                   {!!Form::label('twitter',trans('admin.twitter'))!!}
                  {!!Form::text('twitter',$manufacts->twitter,['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                   {!!Form::label('website',trans('admin.website'))!!}
                  {!!Form::text('website',$manufacts->website,['class'=>'form-control'])!!}
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
