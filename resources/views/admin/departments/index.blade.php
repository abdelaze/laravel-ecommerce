@extends('admin.index')
@section('content')

@push('js')

<!-- Trigger the modal with a button -->


<!-- Modal -->
<div id="del_bootstrap_dep" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{trans('admin.delete')}}</h4>
      </div>
      {!!Form::open(['url'=>'','method'=>'delete','id'=>'form_Delete_dep'])!!}
      <div class="modal-body">
              <h4>{{trans('admin.del_depart')}}<span class="dep_name"></span>?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        {!!Form::submit(trans('admin.yes'),['class'=>'btn btn-danger form-control'])!!}



      </div>
          {!!Form::close()!!}
    </div>

  </div>
</div>


<script type="text/javascript">

$(document).ready(function(){

  $('#jstree').jstree({
          "core" : {

            'data' : {!!load_dep()!!},// how the data will appear in the page


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
           name.push(data.instance.get_node(data.selected[i]).text); // text mean dep_name i use it in load_dep method
        }
        // we will make hidden input to take the value select and put it in the data base i can select more than one parent

        $('.parent_id').val(r.join(', ')); // join to make the array like that for example 1,2,3,...


       $('#form_Delete_dep').attr('action','{{aurl("departments")}}/'+r.join(', '));
        $('.dep_name').text('  '+name.join(', '));

       // mean if i click to any category show the buuton   beacuse when i click to any category i add this id to the button and goto to edit page
        if(r.join(', ') !== '') { //any  mean i click in  dep

               $('.showbtn_control').removeClass('hidden');
               $('.dep_edit').attr('href','{{aurl("departments")}}/'+r.join(', ')+'/edit');

        }else {
           $('.showbtn_control').addClass('hidden');
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

            <a href="" class="btn btn-info dep_edit showbtn_control hidden"><i class="fa fa-edit"></i>{{trans('admin.edit')}}</a>
            <a href="" class="btn btn-danger dep_del showbtn_control hidden" data-toggle="modal" data-target="#del_bootstrap_dep"><i class="fa fa-trash"></i>{{trans('admin.delete')}}</a>

              <div id="jstree"></div>
            <input type="hidden" name="parent" class="parent_id" value="">
          </div>
          <!-- /.box-body -->
</div>
        <!-- /.box -->




@endsection
