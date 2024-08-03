<?php

namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Config;
use DB;
class AuthController extends Controller
{
    
    public function RegisterStore()
    {
        if(Auth::check()){
            redirect('dashboard');
        }
        return view('admin.auth.register');
    }

    public function RegisterCreate(Request $request){
        $validator = Validator::make($request->all(), [
           'name' => 'required',
           'last_name' => 'required',
           'email' => 'required|email|unique:users,email',
           'username' => 'required|unique:users,username',
           'mobile' => 'required|digits:10',
           'password' => 'required',
           'budget_limit' => 'required',
           'duration' => 'required',
       ]);
        if($validator->passes()){
          $userRegister = new User();
          $userRegister->name = isset($request->name) ? $request->name : '';
          $userRegister->last_name = isset($request->last_name) ? $request->last_name : '';
          $userRegister->email = isset($request->email) ? $request->email : '';
          $userRegister->username = isset($request->username) ? $request->username : '';
          $userRegister->mobile = isset($request->mobile) ? $request->mobile : '';
          $userRegister->budget_limit = isset($request->budget_limit) ? $request->budget_limit : '';
          $userRegister->duration = isset($request->duration) ? $request->duration : '';
          $userRegister->password = Hash::make($request->password);
          $userRegister->save();
          return response()->json([
           'status' => true,
           'message' => "User register succssfully",
       ]);
   }else{
      return response()->json([
          'status' => false,
          'errors' => $validator->errors(),
       ]);
   
     }
   
   }


    public function loginForm()
    {
        if(Auth::check()){
            redirect('dashboard');
        }
        return view('admin.auth.login');
    }


    public function authuser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user_name = $request->email;
        $password = $request->password;

        if (filter_var($user_name, FILTER_VALIDATE_EMAIL)) {
            Auth::attempt(['email' => $user_name, 'password' => $password]);
        } else {
            Auth::attempt(['user_name' => $user_name, 'password' => $password]);
        }

        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->usertype == 'Superadmin') {
                session(['usertype' => $user->usertype]);
                return redirect()->intended(route('admin.dashboard'))->withSuccess('Signed in');
            } else {
                Auth::logout();
                return back()->withErrors(['error' => 'Your account is not yet active.']);
            }
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $income = DB::table('transactions')->where('type', 'income')->sum('amount');
        $expenses = DB::table('transactions')->where('type', 'expense')->sum('amount');
        $balance = $income - $expenses;

        // Example data for charts
        $incomeData = DB::table('transactions')
        ->where('type', 'income')
        ->select(DB::raw('DATE_FORMAT(date, "%Y-%m") as month'), DB::raw('SUM(amount) as total'))
        ->groupBy('month')
        ->pluck('total', 'month');

    $expenseData = DB::table('transactions')
        ->where('type', 'expense')
        ->select(DB::raw('DATE_FORMAT(date, "%Y-%m") as month'), DB::raw('SUM(amount) as total'))
        ->groupBy('month')
        ->pluck('total', 'month');


        if($user->usertype == "Superadmin"){
            return view('admin.dashboard.dashboard', [
                'income' => $income,
                'expenses' => $expenses,
                'balance' => $balance,
                'incomeData' => $incomeData,
                'expenseData' => $expenseData,
            ]);
        }
      }

      public function logoutUser(Request $request) {
        Auth::logout();
        Session::flush();
        return redirect()->route('user-login');
    }

}
