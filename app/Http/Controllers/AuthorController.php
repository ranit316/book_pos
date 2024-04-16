<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AuthorController extends Controller
{

    public $page = 'Author';
    public function index(Request $request)
    {
        if ((auth()->user()->role_id != 3) && (auth()->user()->type == 'central-store')) {
            abort(404);
        }
        if ((auth()->user()->role_id != 1) && (auth()->user()->type == 'retail-store')) {
            abort(404);
        }
        $page = $this->page;
        if ($request->ajax()) {
            if (isAdmin()) {
                $data = Author::get();
            }
            if (isPublisher() || isCentral() || isRetail()) {
                $data = Author::where('status', 'active')->orderBy('name', 'asc')->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('status', function ($row) {
                //     $checked = $row->status == 'active' ? 'checked' : '';
                //  return '<div class="form-check form-switch form-switch-md mb-2">
                //   <input class="form-check-input" type="checkbox" id="toggleSwitch_' . $row->id . '" ' . $checked . '>
                //   <label class="form-check-label" for="toggleSwitch_' . $row->id . '"></label>
                //     </div>';
                // })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.author.button', ['item' => $row, "route" => 'author', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.v1.author.index', compact('page'));
    }
    // $author=Author::all();
    // return view('admin.v1.author.index',compact('author'));


    public function add()
    {
        return view('admin.v1.author.add');
    }

    public function author_add(Request $request)
    {
        $author = new Author;

        $author->name = $request['name'];
        $author->description = $request['description'];

        if(auth()->user()->type == 'publisher'){
            $author->status = 'inactive';
        }else{
            $author->status = 'active';
        }
        $author->created_by = auth()->user()->id;

        $author->save();
        return redirect('/author/index');
    }

    public function status($id)
    {
        $status = Author::find($id);
        if ($status->status == "active") {
            Author::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            Author::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }

    public function delete($id)
    {
        $author = Author::find($id);
        if (!is_null($author)) {
            $author->delete();
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $edit = Author::where('id', $id)->first();
        return view('admin.v1.author.editauthor', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        Author::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'updated_by' => auth()->user()->id,
        ]);
        return redirect()->route('auth.index');
    }
}
