<?php

namespace App\Http\Controllers;

use App\Models\chinedu;
use Illuminate\Http\Request;

class NeduController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("post")) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|string'
            ]);
            
            $save = chinedu::create($request->all());

            if ($save) {
                return back()->with("success", "Message submitted successfully");
            }

            return back()->with("error", "Failed to submit message. Please try again.");
        }

        $data = chinedu::latest()->get();
        return view("chinedu", compact("data"));
    }

    public function delete(Request $request)
    {
        $record = chinedu::find($request->id);
        
        if (!$record) {
            return back()->with("error", "Record not found");
        }

        $record->delete();
        return redirect()->route('nedu')->with("success", "Record deleted successfully");
    }
}
