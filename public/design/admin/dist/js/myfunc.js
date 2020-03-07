function check_all() {

   $('input[class="item_check"]:checkbox').each(function(){
        if($('input[class="check_all"]:checkbox:checked').length == 0) {
           $(this).prop('checked',false);
        }else {
            $(this).prop('checked',true);
        }
   });
}


// This Function To Delete All Items In Database


function delete_all(){
  
  $(document).on('click','.del_all',function(){

       $('#form_data').submit();

  });

   $(document).on('click','.Btn_Delete',function(){

       $items_checked = $('input[class="item_check"]:checkbox').filter(':checked').length;
       if($items_checked>0) {

            $('.record_count').text($items_checked);
            $('.no_empty_record').removeClass('hidden');
            $('.empty_record').addClass('hidden');
       }else {
             $('.record_count').text('');
           $('.empty_record').removeClass('hidden');
           $('.no_empty_record').addClass('hidden');
       }



      $('#multiple_delete').modal('show');
   });
}
