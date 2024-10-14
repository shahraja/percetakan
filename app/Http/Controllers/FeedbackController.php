<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Product;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function feedback()
    {
        $products = Product::all();
        return view('client.feedback', compact('products'));
    }

    public function feedbackStore(Request $request)
    {
        $request->validate([
            'name' => 'required:max:50',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'review' => 'required',
            'rating' => 'required|numeric|max:5|min:1',
        ]);

        $feedback = new Feedback();
        $feedback->name = $request->input('name');
        $feedback->review = $request->input('review');
        $feedback->rating = $request->input('rating');

        if ($request->hasFile('img')) {
            $feedback->img = $request->file('img')->store('public');
        }

        $feedback->save();

        return redirect()->back();
    }
}
