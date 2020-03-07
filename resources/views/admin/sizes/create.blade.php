@extends('admin.index')
@section('content')

@push('js')
<script type="text/javascript">

$(document).ready(function(){

  $('#jstree').jstree({
          "core" : {

            'data' : {!!load_dep(old('department_id'))!!},// how the data will appear in the page


            "themes" : {
              "variant" : "large"
            }
          },
          "checkbox" : {
            "keep_selected_style" : true
          },
          "plugins" : [ "wholerow" ] // i will use wholerow and checkbox add them in plugins
});

});



$('#jstree').on("changed.jstree", function (e, data) {
        var i,j,r = [];
        var name = [];
        for(i=0,j=data.selected.length;i<j;i++) {
           r.push(data.instance.get_node(data.selected[i]).id); // will put the id of dep in the array when i select it
        //   name.push(data.instance.get_node(data.selected[i]).text); // text mean dep_name i use it in load_dep method
        }
        // we will make hidden input to take the value select and put it in the data base i can select more than one parent


       // mean if i click to any category show the buuton   beacuse when i click to any category i add this id to the button and goto to edit page
        if(r.join(', ') !== '') { //any  mean i click in  dep

              $('.department_id').val(r.join(', '));

        }
});


</script>


@endpush
<div class="box">

          <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
          </div>
          <!-- /.box-header -->
      <div class="box-body">

            {!!Form::open(['route'=>'sizes.store'])!!}


                 <div class="form-group">
                   {!!Form::label('name_ar',trans('admin.name_ar'))!!}
                  {!!Form::text('name_ar',old('name_ar'),['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                   {!!Form::label('name_en',trans('admin.name_en'))!!}
                  {!!Form::text('name_en',old('name_en'),['class'=>'form-control'])!!}
                 </div>



                  <div id="jstree"></div>
                 <input type="hidden" name="department_id" class="department_id" value="{{old('department_id')}}">


                 <div class="form-group">
                   {!!Form::label('is_public',trans('admin.is_public'))!!}
                   {!!Form::select('is_public',['yes'=>trans('admin.yes'),'no'=>trans('admin.no')],old('is_public'),['class'=>'form-control'])!!}
                 </div>





                 <div class="form-group">

                    {!!Form::submit(trans('admin.add'),['class'=>'btn btn-primary'])!!}
                  </div>

            {!!Form::close()!!}
    </div>
          <!-- /.box-body -->
</div>
        <!-- /.box -->



@endsection
