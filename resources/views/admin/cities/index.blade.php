@extends('admin.index')
@section('content')

<div class="box">
          <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">

            {!!Form::open(['id'=>'form_data','url'=>aurl('cities/destroy/all'),'method'=>'delete'])!!}

            {!! $dataTable->table(['class' => 'dataTable table table-bordered table-striped table-hover'],true)!!}
              <!-- // we put true to show search in column -->
           {!!Form::close()!!}
          </div>
          <!-- /.box-body -->
</div>
        <!-- /.box -->




        <!-- The Modal -->
        <div class="modal" id="multiple_delete">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">{{trans('admin.del_all')}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <div class="empty_record hidden">
                  {{trans('admin.please_check_some_records')}}
                </div>
                <div class="no_empty_record hidden">
                  {{trans('admin.ask_delete_itme')}} <span class="record_count">5</span>

                </div>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">

              <div class="empty_record hidden">
                 <button type="button" class="btn btn-success" data-dismiss="modal">{{trans('admin.close')}}</button>
              </div>

            <div class="no_empty_record hidden">
                <button type="button" class="btn btn-success" data-dismiss="modal">{{trans('admin.no')}}</button>
                <input type="submit" value="{{trans('admin.yes')}}" name="del_all"  class="btn btn-danger del_all">
            </div>

              </div>

            </div>
          </div>
        </div>

@push('js')

<script>delete_all();</script>
{!! $dataTable->scripts()!!}
@endpush
@endsection
