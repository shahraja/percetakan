<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function edit($id)
    {
        $aboutPage = AboutPage::findOrFail(1); 
        return view('admin.about.edit', compact('aboutPage'));
    }

    public function update(Request $request, $id)
    {   
        $aboutPage = AboutPage::findOrFail($id);
        
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:5000',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = time() . '.' . $image->getClientOriginalExtension();
            $aboutPage->image = $file_name;
            $aboutPage->update();
            $image->storeAs('public/assets/img/', $image->hashName());
            // $image->move('../public/assets/about/', $file_name);
        }

        // dd($request->all());

        $aboutPage->description = $request->description;
        $aboutPage->save();

        return redirect('admin/about/1/edit');
    }
}
