<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;
class TransactionController extends Controller
{
    public function index(Request $request)
    {
        
       
        if ($request->ajax()) {
           $mainQuery = DB::table('transactions')->whereNull('transactions.deleted_at')
           ->select([
               'transactions.id',
               'transactions.user_id',
               'transactions.description',
               'transactions.amount',   
               'transactions.date',   
               'transactions.type',   
               'transactions.category_id',   
               'users.name',   
               'users.last_name',   
               'users.username',   
               'categories.categorie_name',   
           ])
           ->leftJoin('users', 'users.id', 'transactions.user_id')
           ->leftJoin('categories', 'categories.id', 'transactions.category_id')
           ;
           $data = $mainQuery->get();
           return Datatables::of($data)
                    ->setRowId(function ($row) {
                        return $row->id;
                    })
                    ->addColumn('index', function ($row) {
                        static $index = 0;
                        return ++$index;
                    })
                    ->addColumn('name', function ($row) {
                        return $row->name;
                    })
                    ->addColumn('categorie_name', function ($row) {
                        return $row->categorie_name;
                    })
                    ->addColumn('amount', function ($row) {
                        return $row->amount;
                    })
                    ->addColumn('type', function ($row) {
                        return $row->type;
                    })
                    ->addColumn('description', function ($row) {
                        return $row->description;
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route("transaction.edit", ["id" => $row->id]) . '">
                        <i class="mdi me-2 mdi-account-edit" style="font-size:24px;color:green;"></i></a>';

                        $btn .=  '<a  class="delete-button" data-id="' . $row->id .'"><i class="mdi me-2 mdi-delete" style="font-size:24px;"></i></a>';

                         return $btn;
                    })
                    ->rawColumns(['action','categori_name','status','index'])
                    ->make(true);
        }
        return view('admin.transactions.index', [
        ]);
    }


    public function create()
    {
        $category_data = DB::table('categories')->where('deleted_at',null)->get();
        $user = Auth::user();
        $budget_limit  = $user->budget_limit;
        return view('admin.transactions.create', compact('category_data','budget_limit'));
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
            "category" => 'required',
            "amount" => 'required',
            "date" => 'required',
            "type" => 'required',
            "description" => 'required',
        ]);
        if($validator->passes()){
            $user = Auth::user();

            /* if($request->category ){

            } */


            $TransactionCreate = new Transaction();
            $TransactionCreate->category_id = $request->category;
            $TransactionCreate->amount = $request->amount;
            $TransactionCreate->date = $request->date;
            $TransactionCreate->type = $request->type;
            $TransactionCreate->description = $request->description;
            $TransactionCreate->user_id = $user->id;
            $TransactionCreate->save();
            return response()->json([
                'status' => true,
                'message' => "Transaction created successfully",
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
        $edit = Transaction::whereNull('deleted_at')
            ->where('id', $id)
            ->first();
            $category_data = DB::table('categories')->where('deleted_at',null)->get();    
        return view('admin.transactions.update', compact('edit','category_data'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "category" => 'required',
            "amount" => 'required',
            "date" => 'required',
            "type" => 'required',
            "description" => 'required',
        ]);
        if($validator->passes()){
            $user = Auth::user();
            $TransactionUpdate = Transaction::find($request->transaction_id);
            $TransactionUpdate->category_id = $request->category;
            $TransactionUpdate->amount = $request->amount;
            $TransactionUpdate->date = $request->date;
            $TransactionUpdate->type = $request->type;
            $TransactionUpdate->description = $request->description;
            $TransactionUpdate->user_id = $user->id;
            $TransactionUpdate->save();
            return response()->json([
                'status' => true,
                'message' => "Transaction update successfully",
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

        $model = Transaction::find($id);
        $model->delete();
        echo 'removed';
        die; 
        
    }

    public function MonthlyReport(Request $request)
    {
        if ($request->ajax()) {

            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $type = $request->input('type');

            $mainQuery = DB::table('transactions')->whereNull('transactions.deleted_at')
            ->select([
                'transactions.id',
                'transactions.user_id',
                'transactions.description',
                'transactions.amount',   
                'transactions.date', 
                DB::raw("DATE_FORMAT(transactions.date, '%d-%m-%Y') as formatted_date"), // Example format
                'transactions.type',   
                'transactions.category_id',   
                'users.name',   
                'users.last_name',   
                'users.username',   
                'categories.categorie_name',   
            ])
            ->leftJoin('users', 'users.id', 'transactions.user_id')
            ->leftJoin('categories', 'categories.id', 'transactions.category_id');

            if (isset($start_date) && isset($end_date)) {
                $mainQuery->whereBetween('transactions.date', [$start_date, $end_date]);
            }
            if (isset($type) && isset($type)) {
                $mainQuery->where('transactions.type', $type);
            }
            $data = $mainQuery->get();
            return Datatables::of($data)
                     ->setRowId(function ($row) {
                         return $row->id;
                     })
                     ->addColumn('index', function ($row) {
                         static $index = 0;
                         return ++$index;
                     })
                     ->addColumn('name', function ($row) {
                         return $row->name;
                     })
                     ->addColumn('categorie_name', function ($row) {
                         return $row->categorie_name;
                     })
                     ->addColumn('amount', function ($row) {
                         return $row->amount;
                     })
                     ->addColumn('type', function ($row) {
                         return $row->type;
                     })
                     ->addColumn('date', function ($row) {
                         return $row->formatted_date;
                     })

                    
                     ->addColumn('action', function ($row) {
                         $btn = '<a href="' . route("transaction.edit", ["id" => $row->id]) . '">
                         <i class="mdi me-2 mdi-account-edit" style="font-size:24px;color:green;"></i></a>';
 
                         $btn .=  '<a  class="delete-button" data-id="' . $row->id .'"><i class="mdi me-2 mdi-delete" style="font-size:24px;"></i></a>';
 
                          return $btn;
                     })
                     ->rawColumns(['action','categori_name','status','index'])
                     ->make(true);
         }
         return view('admin.transactions.report', [
         ]);
    }

    public function downloadReport(Request $request)
    {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $type = $request->input('type');
            $mainQuery = DB::table('transactions')->whereNull('transactions.deleted_at')
            ->select([
                'transactions.id',
                'transactions.user_id',
                'transactions.description',
                'transactions.amount',   
                'transactions.date', 
                DB::raw("DATE_FORMAT(transactions.date, '%d-%m-%Y') as formatted_date"), // Example format
                'transactions.type',   
                'transactions.category_id',   
                'users.name',   
                'users.last_name',   
                'users.username',   
                'categories.categorie_name',   
            ])
            ->leftJoin('users', 'users.id', 'transactions.user_id')
            ->leftJoin('categories', 'categories.id', 'transactions.category_id');

            if (isset($start_date) && isset($end_date)) {
                $mainQuery->whereBetween('transactions.date', [$start_date, $end_date]);
            }
            if (isset($type) && isset($type)) {
                $mainQuery->where('transactions.type', $type);
            }
            $data = $mainQuery->get();
        
            $pdf = PDF::loadView('admin.transactions.monthly-report', [
               // 'start_date' => $start_date,
              //  'end_date' => $end_date,
                'ReportData' => $data,
                //'expenseData' => $expenseData,
            ]);
        
            return $pdf->download('Monthly-Report.pdf');
            
    }

    public function RecurringTransaction(Request $request)
    {
        if ($request->ajax()) {

            $start_date = $request->input('start_date');
           // $end_date = $request->input('end_date');
            $type = $request->input('type');

            $mainQuery = DB::table('transactions')->whereNull('transactions.deleted_at')
            ->select([
                'transactions.id',
                'transactions.user_id',
                'transactions.description',
                'transactions.amount',   
                'transactions.date', 
                DB::raw("DATE_FORMAT(transactions.date, '%d-%m-%Y') as formatted_date"), // Example format
                'transactions.type',   
                'transactions.category_id',   
                'users.name',   
                'users.last_name',   
                'users.username',   
                'categories.categorie_name',   
            ])
            ->leftJoin('users', 'users.id', 'transactions.user_id')
            ->leftJoin('categories', 'categories.id', 'transactions.category_id');

            if (isset($start_date) && isset($start_date)) {
                $mainQuery->where('transactions.date', [$start_date]);
            }
            if (isset($type) && isset($type)) {
                $mainQuery->where('transactions.type', $type);
            }
            $data = $mainQuery->get();
            return Datatables::of($data)
                     ->setRowId(function ($row) {
                         return $row->id;
                     })
                     ->addColumn('index', function ($row) {
                         static $index = 0;
                         return ++$index;
                     })
                     ->addColumn('name', function ($row) {
                         return $row->name;
                     })
                     ->addColumn('categorie_name', function ($row) {
                         return $row->categorie_name;
                     })
                     ->addColumn('amount', function ($row) {
                         return $row->amount;
                     })
                     ->addColumn('type', function ($row) {
                         return $row->type;
                     })
                     ->addColumn('date', function ($row) {
                         return $row->formatted_date;
                     })

                    
                     ->addColumn('action', function ($row) {
                         $btn = '<a href="' . route("transaction.edit", ["id" => $row->id]) . '">
                         <i class="mdi me-2 mdi-account-edit" style="font-size:24px;color:green;"></i></a>';
 
                         $btn .=  '<a  class="delete-button" data-id="' . $row->id .'"><i class="mdi me-2 mdi-delete" style="font-size:24px;"></i></a>';
 
                          return $btn;
                     })
                     ->rawColumns(['action','categori_name','status','index'])
                     ->make(true);
         }
         return view('admin.transactions.recurring-transaction', [
         ]);
    }

}
