<?php

namespace App\DataTables;
use App\Model\Size;
use Yajra\DataTables\Services\DataTable;

class SizesDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
         // wirte the action and the path of the page

            ->addColumn('checkbox', 'admin.sizes.btn.checkbox')
             ->addColumn('edit', 'admin.sizes.btn.edit')
            ->addColumn('delete', 'admin.sizes.btn.delete')
              ->addColumn('is_public', 'admin.sizes.btn.is_public')

            ->rawcolumns([
              'checkbox',
              'edit',
              'delete',
              'is_public',



            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        //return $model->newQuery()->select('id', 'add-your-columns-here', 'created_at', 'updated_at');
         return Size::query()->with('department_id')->select('sizes.*');;
        // country_id mean the method which i made in the model
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                  //  ->addAction(['width' => '80px'])
                  //  ->parameters($this->getBuilderParameters());
                  // I Made It By My Self
                  ->parameters([
                    'dom' =>'Blfrtip',
                    'lengthMenu' =>[[10,25,50,100],[10,25,50,'All Record']],
                   'buttons' => [
                     [
                       'text'=>'<i class="fa fa-plus"></i>'.trans('admin.create'),
                       'className'=>'btn btn-primary',"action"=>"function(){

                           window.location.href = '".\URL::current()."/create';
                       }",
                     ],
                      ['extend' =>'print','className'=>'btn btn-info','text'=>'<i class="fa fa-print"></i>'],
                      ['extend' =>'postCsv','className'=>'btn btn-success','text'=>'<i class="fa fa-file"></i>'.trans('admin.ex_csv')],
                      ['extend' =>'reload','className'=>'btn btn-default','text'=>'<i class="fa fa-refresh"></i>'],
                      ['extend' =>'postExcel','className'=>'btn btn-info','text'=>'<i class="fa fa-file"></i>'.trans('admin.ex_excel')],
                      [
                        'text'=>'<i class="fa fa-trash"></i>','className'=>'btn btn-danger Btn_Delete'
                      ],
                    ], // end of buttons
                    'initComplete' => "function () {
                                       this.api().columns([1,2]).every(function () {
                                       var column = this;
                                       var input = document.createElement(\"input\");
                                        $(input).appendTo($(column.footer()).empty())
                                        .on('keyup', function () {
                                            column.search($(this).val(), false, false, true).draw();
                                        });
                                   });
                                }",




                  // the number in columns index for each column

                  'language' => datatableLanguage(),  // This Helper function for only words in datatables

                 // "processing"=> true,
                 // "serverSide"=> true,
                 // "deferRender"=>false,


              ]);

    }


    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {


        return [
          [
            'name'=>'id',
            'data'=>'id',
            'title'=>'ID',
          ],
          [
            'name'=>'name_ar',
            'data'=>'name_ar',
            'title'=>trans('admin.name_ar'),
          ],
          [
            'name'=>'name_en',
            'data'=>'name_en',
            'title'=>trans('admin.name_en'),
          ],


          [
            'name'=>'department_id.dep_name_'.session('lang'),
            'data'=>'department_id.dep_name_'.session('lang'),
            'title'=>trans('admin.department'),
          ],


          [
            'name'=>'is_public',
            'data'=>'is_public',
            'title'=>trans('admin.is_public'),
          ],


          [
            'name'=>'created_at',
            'data'=>'created_at',
            'title'=>trans('admin.created_at'),
          ],

          [
            'name'=>'updated_at',
            'data'=>'updated_at',
            'title'=>trans('admin.updated_at'),
          ],
          [
            'name'=>'edit',
            'data'=>'edit',
            'title'=>trans('admin.edit'),
            'exportable' =>false,
            'printable' =>false,
            'searchable' =>false,
            'orderable'  =>false,


          ],
          [
            'name'=>'delete',
            'data'=>'delete',
            'title'=>trans('admin.delete'),
            'exportable' =>false,
            'printable' =>false,
            'searchable' =>false,
            'orderable'  =>false,


          ],

          [
            'name'=>'checkbox',
            'data'=>'checkbox',
            'title'=>'<input type="checkbox" class="check_all" onClick="check_all()">', //checkAll To Detect All Data In The Table and i will made it in header
            'exportable' =>false,
            'printable' =>false,
            'searchable' =>false,
            'orderable'  =>false,


          ],



        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Size_' . date('YmdHis');
    }
}
