<?php

namespace App\DataTables;
use App\Model\State;
use Yajra\DataTables\Services\DataTable;

class StateDatatable extends DataTable
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

            ->addColumn('checkbox', 'admin.states.btn.checkbox')
             ->addColumn('edit', 'admin.states.btn.edit')
            ->addColumn('delete', 'admin.states.btn.delete')

            ->rawcolumns([
              'edit',
              'delete',
              'checkbox',

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
         return State::query()->with('country_id')->with('city_id')->select('states.*'); // select(cities) mean the country_id in city table and this when i use foreign key

        // ->with Also Used When i want to get data form another table and i want to displayed with this datatable
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
                                       this.api().columns([1,2,3,4]).every(function () {
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
            'name'=>'state_name_ar',
            'data'=>'state_name_ar',
            'title'=>trans('admin.state_name_ar'),
          ],
          [
            'name'=>'state_name_en',
            'data'=>'state_name_en',
            'title'=>trans('admin.state_name_en'),
          ],

          [
            'name'=>'country_id.country_name_'.session('lang'),
            'data'=>'country_id.country_name_'.session('lang'),
            'title'=>trans('admin.country_id'),
          ],

          [
            'name'=>'city_id.city_name_'.session('lang'),
            'data'=>'city_id.city_name_'.session('lang'),
            'title'=>trans('admin.city_id'),
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
        return 'State_' . date('YmdHis');
    }
}
