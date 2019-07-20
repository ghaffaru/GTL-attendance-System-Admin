<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Arrival;
use App\Departure;
class HomeController extends Controller
{
    public function home($value='')
    {
    	return view('welcome');
    }
    public function YourhomePage($value='')
    {
    	return view('home');
    }
    public function dashboard($value='')
    {
        $employees = User::all();
        $attendance_today = Arrival::whereRaw('DATE(created_at) = CURRENT_DATE')->get();
        $attendance_this_week = Arrival::whereRaw('YEARWEEK(created_at,1) = YEARWEEK(CURDATE(),1)')->get();
        // $absentees_today = Arrival::whereRaw('DATE(created_at) = CURRENT_DATE')->get();
    	return view('backEnd.dashboard',compact('employees','attendance_today','attendance_this_week'));
    }

    public function viewQrs()
    {
        $users = User::where('id','!=',1)->get();
        return view('backEnd.qr-codes',compact('users'));
    }

    public function userSearch()
    {
        $user_id = (int)request('answer');

        // dd($user_id);
        // $details->created_at);
         $users = User::where('id','!=',1)->get();
        //  $details = Arrival::where('user_id',$user_id)->get();
        //   dd($details->first()['created_at']);
        return view('backEnd.user-search',compact('users'));
    }

    public function handleUserSearch() 
    {
        $user_id = (int)request('answer');

        // dd($user_id);
        // $details->created_at);
         $users = User::where('id','!=',1)->get();
         $details = Arrival::where('user_id',$user_id)->get();
        //   dd($details->first()['created_at']);
        return view('backEnd.user-search',compact('details','users'));
    }

    public function attendance()
    {
        $ppl_arr = Arrival::whereDate('created_at',date('Y-m-d'))->get();
        $ppl_dept = Departure::whereDate('created_at',date('Y-m-d'))->get();
        return view('backEnd.attendance',compact('ppl_arr','ppl_dept'));
    }

    public function sortdate()
    {
        $ppl_arr = Arrival::whereDate('created_at',request('date'))->get();
        $ppl_dept = Departure::whereDate('created_at',request('date'))->get();
        $date = request('date');
        return view('backEnd.attendance',compact('ppl_arr','ppl_dept','date'));
    }
}
