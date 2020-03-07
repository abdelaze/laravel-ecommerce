@extends('admin.index')
@section('content')


@push('js')
<script type="text/javascript">

$(document).ready(function(){

  $('#jstree').jstree({
          "core" : {

            'data' : {!!load_dep($department->parent,$department->id)!!}, // how the data will appear in the page


            "themes" : {
              "variant" : "large"
            }
          },
          "checkbox" : {
            "keep_selected_style" : false
          },
          "plugins" : [ "wholerow" ] // i will use wholerow and checkbox add them in plugins
});

});




$('#jstree').on("changed.jstree", function (e, data) {
        var i,j,r = [];
        for(i=0,j=data.selected.length;i<j;i++) {
           r.push(data.instance.get_node(data.selected[i]).id); // will put the id of dep in the array when i select it
        }
        // we will make hidden input to take the value select and put it in the data base i can select more than one parent

        $('.parent_id').val(r.join(', ')); // join to make the array like that for example 1,2,3,...
});





</script>


@endpush


<div class="box">

          <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
          </div>
          <!-- /.box-header -->
      <div class="box-body">

            {!!Form::open(['route'=>['departments.update',$department->id],'method'=>'put','files'=>true])!!}

                 <div class="form-group">
                   {!!Form::label('dep_name_ar',trans('admin.dep_name_ar'))!!}
                  {!!Form::text('dep_name_ar',$department->dep_name_ar,['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                   {!!Form::label('dep_name_en',trans('admin.dep_name_en'))!!}
                  {!!Form::text('dep_name_en',$department->dep_name_en,['class'=>'form-control'])!!}
                 </div>
                 <div class="clearfix"> </div>
                     <div id="jstree"></div>
                     <input type="hidden" name="parent" class="parent_id" value="{{$department->parent}}">
                 <div class="clearfix"> </div>


                 <div class="form-group">
                   {!!Form::label('description',trans('admin.description'))!!}
                  {!!Form::textarea('description',$department->description,['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                   {!!Form::label('keyword',trans('admin.keyword'))!!}
                  {!!Form::textarea('keyword',$department->keyword,['class'=>'form-control'])!!}
                 </div>

                 <div class="form-group">
                   {!!Form::label('icon',trans('admin.icon'))!!}
                  {!!Form::file('icon',$department->icon,['class'=>'form-control'])!!}
                 </div>




                 <div class="form-group">

                    {!!Form::submit(trans('admin.save'),['class'=>'btn btn-primary'])!!}
                  </div>

            {!!Form::close()!!}
    </div>
          <!-- /.box-body -->
</div>
        <!-- /.box -->



@endsection
