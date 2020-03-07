@extends('admin.index')
@section('content')

@push('js')
<script type="text/javascript">
 $(document).ready(function(){

   $.ajaxSetup({

     headers: {

         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

     }

 });


    @if(old('country_id')) // bacuse if error happen and i will return to the form again this make ajax work again
    $.ajax({

       url: "{{ route('states.create') }}",
       type:'GET',
      dataType:'html',
      data :{
        'country_id':'{{old("country_id")}}',
        'select'  : '{{old("city_id")}}', // mean the value that will appear in the select it is not important but put this variable

      },

      success : function(data){

           $('.city_id').html(data);
      }


    });
    @endif
     $(document).on('change','.country_id',function(){

      // alert('zaza')

        var country = $('.country_id option:selected').val();
        if(country>0) { // mean i choice option

            $.ajax({

               url: "{{ route('states.create') }}",
               type:'GET',
              dataType:'html',
              data :{
                'country_id':country,
                'select'  : '', // mean the value that will appear in the select it is not important but put this variable

              },

              success : function(data){

                   $('.city_id').html(data);
              }


            });

        }else {
           $('.city_id').html('');
        }

     });


 });
</script>

@endpush
<div class="box">

          <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
          </div>
          <!-- /.box-header -->
      <div class="box-body">

            {!!Form::open(['route'=>'states.store'])!!}

                 <div class="form-group">
                   {!!Form::label('state_name_ar',trans('admin.state_name_ar'))!!}
                  {!!Form::text('state_name_ar',old('state_name_ar'),['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                   {!!Form::label('state_name_en',trans('admin.state_name_en'))!!}
                  {!!Form::text('state_name_en',old('state_name_en'),['class'=>'form-control'])!!}
                 </div>

                 <div class="form-group">
                   {!!Form::label('country_id',trans('admin.country_id'))!!}
                   {!!Form::select('country_id',App\Model\Country::pluck('country_name_'.session('lang'),'id'),old('country_id'),['class'=>'form-control country_id','placeholder'=>'................'])!!}
                 </div>

                 <div class="form-group">
                   {!!Form::label('city_id',trans('admin.city_id'))!!}
                  <span class="city_id"></span>
                 </div>

                 <!-- <div class="form-group">
                   {!!Form::label('city_id',trans('admin.city_id'))!!}
                   {!!Form::select('city_id',App\Model\City::pluck('city_name_'.session('lang'),'id'),['class'=>'form-control'])!!}
                 </div> -->


                 <div class="form-group">

                    {!!Form::submit(trans('admin.add'),['class'=>'btn btn-primary'])!!}
                  </div>

            {!!Form::close()!!}
    </div>
          <!-- /.box-body -->
</div>
        <!-- /.box -->



@endsection
