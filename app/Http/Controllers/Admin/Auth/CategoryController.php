<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        
       
        if ($request->ajax()) {
           $mainQuery = DB::table('categories')->whereNull('categories.deleted_at')
           ->select([
               'categories.id',
               'categories.categorie_name',
               'categories.created_at',
               'categories.updated_at',   
           ]);
           $data = $mainQuery->get();
           return Datatables::of($data)
                    ->setRowId(function ($row) {
                        return $row->id;
                    })
                    ->addColumn('index', function ($row) {
                        static $index = 0;
                        return ++$index;
                    })
                    ->addColumn('categorie_name', function ($row) {
                        return $row->categorie_name;
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route("category.edit", ["id" => $row->id]) . '">
                        <i class="mdi me-2 mdi-account-edit" style="font-size:24px;color:green;"></i></a>';

                        $btn .=  '<a  class="delete-button" data-id="' . $row->id .'"><i class="mdi me-2 mdi-delete" style="font-size:24px;"></i></a>';

                         return $btn;
                    })
                    ->rawColumns(['action','categori_name','status','index'])
                    ->make(true);
        }
        return view('admin.category.index', [
        ]);
    }


    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "category_name" => 'required',
        ]);
        if($validator->passes()){
            $CategoryCreate = new Category();
            $CategoryCreate->categorie_name = $request->category_name;
            $CategoryCreate->save();
            return response()->json([
                'status' => true,
                'message' => "Category created successfully",
            ], 201);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
             ]);
        
         }
    }

    public function edit($id)
    {
        $edit = Category::whereNull('deleted_at')
            ->where('id', $id)
            ->first();
        return view('admin.category.update', compact('edit'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "category_name" => 'required',
        ]);
        if($validator->passes()){
            $CategoryUpdate = Category::find($request->categories_id);
            $CategoryUpdate->categorie_name = $request->category_name;
            $CategoryUpdate->save();
            return response()->json([
                'status' => true,
                'message' => "Category update successfully",
            ], 201);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
             ]);
        
         }
    }

    public function delete($id)
    {

        $model = Category::find($id);
        $transactions = DB::table('transactions')->where('category_id', $id)->count();
        if ($transactions >= 1) {
            echo 'false';
            die; 
        }else{
            $model->delete();
            echo 'removed';
            die; 
        }
    }
}
