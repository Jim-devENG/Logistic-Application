<?php

namespace App\Http\Controllers;

use App\Models\chinedu;
use Illuminate\Http\Request;

class NeduController extends Controller
{
    public function Nedu(Request $request)
    {
        if($request->isMethod("post")){
           
            // $data = $request->all();

            
            $save = chinedu::Create($request->all());

            // dd($save);
            if($save){

                return back()->with("success", "Successfully Submitted");
            }



        }

        $data_s = chinedu::all();

        // dd($data_s);

        return view("chinedu",compact("data_s"));
    }

    public function delete(Request $request)
    {


       chinedu::where("id" , $request->id)->delete();

      


      return redirect("/nedu");
    }
}
