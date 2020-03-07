
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#my_del{{$id}}"><i class="fa fa-trash"></i></button>

<!-- Modal -->
<div id="my_del{{$id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{trans('admin.del')}}</h4>
      </div>
      {!!Form::open(['route'=>['countries.destroy',$id],'method'=>'delete'])!!}
      <div class="modal-body">
        <h4>{{trans('admin.ask_delete_itme')}}<span>{{session('lang')=='ar'?$country_name_ar:$country_name_en}}</span></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        {!!Form::submit(trans('admin.yes'),['class'=>'btn btn-danger form-control'])!!}



      </div>
          {!!Form::close()!!}
    </div>

  </div>
</div>
