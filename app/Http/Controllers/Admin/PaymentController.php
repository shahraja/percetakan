<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('admin.payment.index', compact('payments'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|max:255',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update([
            'status' => $request->status,
        ]);

        if (auth()->user()->role == 'admin') {
            return back()->with('alert', 'Berhasil Edit User!');
        }
    }
}
