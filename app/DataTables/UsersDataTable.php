<?php

namespace App\DataTables;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query, Request $request)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'users.partials.action')
            ->editColumn('id', function (User $user) {
                $text = $user->id;
                return view('users.partials.edit', compact('user','text'));
            })
            ->editColumn('username', function (User $user) {
                $text = $user->username;
                return view('users.partials.edit', compact('user','text'));
            })
            ->filter(function ($query) use ($request) {
                if ($request->filled('type')) {
                    switch ($request->get('type')) {
                        case 'expired':
                            $query->assigned()->expired();
                            break;
                        case 'unassigned':
                            $query->unassigned();
                            break;
                        case 'assigned':
                            $query->assigned();
                            break;
                        case 'unpaid':
                            $query->unpaid();
                            break;
                    }
                }
               
                if ($request->filled('username')) {
                    $query->where('username', 'like', "%{$request->get('username')}%");
                }

                if ($request->filled('email')) {
                    $query->where('email', 'like', "%{$request->get('email')}%");
                }
              
            });

           
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->select('users.id', 'username');

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->parameters($this->getBuilderParameters())
            ->minifiedAjax()
            ->orderBy(0, 'desc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title(__('ID'))->addClass('text-center'),
            Column::make('username')->title(__('Name'))->addClass('text-center'),
            Column::computed('action')
                ->title(__('Action'))
                ->exportable(false)
                ->orderable(false)
                ->printable(false)
                ->searchable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get default builder parameters.
     *
     * @return array
     */
    protected function getBuilderParameters()
    {
        return [
            "responsive"    => "true",
            "bAutoWidth"    => false,
            "pageLength"    => request()->get('page_length') ?? setting('pag'),
            "bLengthChange" => false,
            "searching"     => false,
            "pagingType"    => "numbers",
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return __('Users') . '_' . request()->get('type') . '_' . date('Y-m-d');
    }
}
