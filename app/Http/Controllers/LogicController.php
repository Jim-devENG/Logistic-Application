<?php

namespace App\Http\Controllers;

use App\Mail\verification;
use App\Models\About;
use App\Models\Blog;
use App\Models\Calculator;
use App\Models\Contact;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LogicController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'pick' => 'required',
                'weight' => 'required',
                'drop' => 'required',
                'distance' => 'required',
                'carrier' => 'required',

            ]);

            $data = $request->all();

            return redirect()->route('data', $data);
        }
        return view('index');
    }
    public function quote(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'pick' => 'required',
                'weight' => 'required',
                'drop' => 'required',
                'distance' => 'required',
                'carrier' => 'required',

            ]);

            $data = $request->all();


            return redirect()->route('data', $data);
        }
        return view('quote');
    }




    public function quote_estimate(Request $request)

    {
        if ($request->isMethod('get')) {
            $data = $request->all();
            $distance = $request->distance;
            $weight = $request->weight;
            $carrier = $request->carrier;

            $cal = Calculator::find(1);

            $KM = $cal['KM_price'];
            $KG = $cal['KG_price'];
            $air = $cal['air_fright'];
            $ocean = $cal['ocean_fright'];
            $road = $cal['road_fright'];

            if ($carrier == 'Air Freight') {
                $calKg = $weight * $KG;
                $calKm = $distance * $KM;
                $totalE = $calKg + $calKm + $air;
                return view('quote-estimate', compact('totalE', 'data'));
            } elseif ($carrier == 'Ocean Freight') {
                $calKg = $weight * $KG;
                $calKm = $distance * $KM;
                $totalE = $calKg + $calKm + $ocean;
                return view('quote-estimate', compact('totalE', 'data'));
            } elseif ($carrier == 'Road Freight') {
                $calKg = $weight * $KG;
                $calKm = $distance * $KM;
                $totalE = $calKg + $calKm + $road;
                return view('quote-estimate', compact('totalE', 'data'));
            }
        }




        if ($request->isMethod('post')) {
            $data = $request->all();
            $tracking = uniqid();
            $status = 'pending';

            $data['tracking_id'] = $tracking;
            $data['status'] = $status;



            $save = Order::Create($data);
            if ($save) {
                
                Mail::to($request->email)->send(new verification($data));

                $name = $request->name;
                $tracking = $tracking;
                $data_order = [

                    'name' => $name,
                    'track' => $tracking

                ];

                return redirect()->route('placed', $data_order);
            }
        }

        return view('quote-estimate', compact('data'));
    }

    public function placed_order(Request $request)
    {
        $data = $request->all();

        return view('placed-order', compact('data'));
    }

    public function about(Request $request)
    {
        $abouts = About::all()->toArray();

        return view('about', compact('abouts'));
    }

    public function blog(Request $request)
    {
        $data_aar = Blog::paginate(6);
        $data = (object) $data_aar;

        $popular = Blog::where(['category' => 'popular'])->get();


        return view('blog', compact('data', 'popular'));
    }

  

    public function readMore_blog(Request $request)
    {


        $data = Blog::find($request->id);
        $popular = Blog::where(['category' => 'popular'])->get();



        return view('Admin.read-more-blog', compact('data', 'popular'));
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'subject' => 'required',
                'comment' => 'required',

            ]);

            $save = Contact::Create($request->all());
            if ($save) {
                return redirect('/contact#contact')->with('success', 'Contact Uploaded Successfully');
            } else {
                return back()->with('error', 'you don cook beans');
            }
        }
        return view('contact');
    }



    public function track_parcel(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([

                'track_id' => 'required'

            ]);
            $tracks = Order::where(['tracking_id' => $request->track_id])->first();

            if ($tracks !== null) {

                return view('track-parcel', compact('tracks'));
            } else {
                return redirect('/track-parcel#track')->with('error', '!Tracking Id does not exit. Confirm and try again');
            }
        }

        return view('track-parcel');
    }

    public function blogApi(Request $request)
    {
        $blogs = Blog::all();
      
        return response()->json($blogs);
        dd($blogs);
    }
    public function singleBlogApi($id)
    {
        $blog = Blog::find($id);
      
        return response()->json($blog);
    }
    public function author()
    {
        $author = User::all();
      
        return response()->json($author);
    }
}
