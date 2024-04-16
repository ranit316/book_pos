<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class GlobalSearchController extends Controller
{

    public    $search_data = array();
    public $search_query;

    protected $all_table = ['districts', 'products'];
    protected $all_route = ['districts' => 'districts.index', 'products' => 'books.index'];
    protected $show_column = ['districts' => ['name', 'state'], 'products' => ['title']];
    protected $lable = ['products' => 'Books'];

    public function index(Request $request)
    {

        // here i have assingin the search query data into the instance variable
        $this->search_query = $request->data;

        // getting the all table from the database
        // $tables = DB::select('SHOW TABLES');
        // foreach ($tables as $table) {
        //     $table = array_values((array)$table)[0];
        //     self::search($table, self::getColumn($table));
        // }
        if (strlen($this->search_query) > 2) {
            foreach ($this->all_table as $table) {
                self::search($table, self::getColumn($table));
            }
        }
        return view('admin.v1.global_search.index', ['datas' => $this->search_data, 'all_route' => $this->all_route, 'show_column' => $this->show_column, 'lable' => $this->lable]);
    }
    // getting the column name of the particular  table 
    private static function getColumn(string $table)
    {
        return Schema::getColumnListing($table);
    }

    // doing the sarch operation here 
    public  function search(string $table, array $columns)
    {
        $table_data =   DB::table($table);
        if (count($table_data->get()) > 0) {
            foreach ($columns as $column) {
                $table_data = $table_data->orWhere($column, 'LIKE', '%' . $this->search_query . '%');
            }
            $table_data = $table_data->limit(20)->get();
            if (count($table_data) > 0) {
                $final_data['table'] = $table;
                $final_data['data'] = $table_data;
                array_push($this->search_data, $final_data);
            }
        }
    }
}
