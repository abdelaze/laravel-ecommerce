 <span class="label
{{ $level == 'user'?'label-primary': '' }}
{{ $level == 'company'?'label-success': '' }}
{{ $level == 'vendor'?'label-info': '' }}
">

{{trans('admin.'.$level)}}

</span>
