<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Payment;
use App\Employee;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    public function payment()
    {
        $user = User::find(Auth::user()->id);
        $email = Auth::user()->email;

        if($user->hasRole('user'))
        {

            $payment = Payment::where('employee_id', $email)
                ->latest()
                ->paginate(20);

            return view('employees-mgmt.payment', compact('payment'));
        }

        if($user->hasRole('admin'))
        {

            $payment = Payment::latest()->paginate(20);

            return view('employees-mgmt.payment', compact('payment'));
        }

    }

    public function postPayment(Request $request)
    {
        $count = Payment::where('employee_id', $request->email)
            ->where('status','!=','closed')
            ->count();

        if($count > 0)
        {

            return redirect()->back()->with('double_payment','please finish your payment');
        }


        else
        {
          $password = str_random(12);
            Payment::create([
                'employee_id' => $request->email,
                'password' => $password,
                'token' => $request->wallet,
                'status' => 'open'
            ]);
            return redirect()->route('payment');
        }


    }

    public function createPayment()
    {
        return view('employees-mgmt.add_payment');
    }

    public function passwordPayment(Payment $payment)
    {
       return view('employees-mgmt.password_payment', compact('payment'));
    }

    public function postPassword(Payment $payment, Request $request)
    {
        $inputpassword = $request->password;
        $password = $payment->password;

        if($inputpassword == $password)
        {
            return view('employees-mgmt.paid', compact('payment'));
        }

        else
        {
          $password = str_random(12);
          $payment->update([
            'password'=>$password
          ]);

            return redirect()->back();
        }

    }

    public function paidPayment(Payment $payment, Request $request)
    {
        $payment->update([
           'payer'=> $request->sender,
            'status'=>'paid'
        ]);
        return redirect()->route('payment');

    }

    public function closePayment(Payment $payment)
    {
        $payment->update([
            'status'=>'closed'
        ]);
        return redirect()->route('payment');

    }
}
