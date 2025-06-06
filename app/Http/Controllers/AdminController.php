<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\Calculator;
use App\Models\Contact;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if(session()->has('login')) {
            return redirect()->route('admin.dashboard');
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:8'
            ]);

            $user = User::where('email', $request->email)->first();
            
            if ($user && Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->put('login', $request->email);
                return redirect()->route('admin.dashboard')->with('username', $user->name);
            }
            
            return back()->with('error', 'Invalid email or password');
        }

        return view('admin.login');
    }

    public function sign_up(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string|min:8'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            if ($user) {
                return redirect()->route('admin.login')->with('success', 'Account created successfully. Please login.');
            }
            
            return back()->with('error', 'Failed to create account. Please try again.');
        }

        return view('Admin.sign-up');
    }

    public function dashboard(Request $request)
    {
        $contacts = Contact::all();

        
       return view('Admin.dashboard', compact('contacts'));
    }

    public function order(Request $request)
    {
        $orders = Order::paginate(10);

       return view('Admin.orders',compact('orders'));
    }

    public function about_admin(Request $request)
    {
      

          $aboutUs= About::all();

   
        

       return view('Admin.about-admin', compact('aboutUs'));
    }

    public function settings(Request $request)
    {
        if ($request->action == 'edit') {
        if ($request->isMethod('post')) {
            $request->validate([
                'about' => 'required',
            ]);

            

         About::where(['id' => 1])->update(['about' => $request->about]);

           
         return back()->with('success', 'Updated Successfully');
        }
        $abouts = About::find($request->id);
    }

       return view('Admin.about-edit' ,compact('abouts'));
    }

    public function calculator(Request $request)
    {
        $rates = Calculator::find(1); //in array

       return view('Admin.calculator', compact('rates'));
    }
    
    public function edit_cal(Request $request)
    {
        if ($request->action == 'edit') {
            if ($request->isMethod('post')) {
                $request->validate([
                    'KM_price' => 'required',
                    'KG_price' => 'required',
                    'air_fright' => 'required',
                    'road_fright' => 'required',
                    'ocean_fright' => 'required',
                ]);
    
                
    
             Calculator::where(['id' => 1])->update(['KG_price' => $request->KG_price, 'KM_price' => $request->KM_price,
            'air_fright' => $request->air_fright, 'ocean_fright' => $request->ocean_fright,'road_fright' => $request->road_fright]);
    
               
            return back()->with('success', 'Updated Successfully');
            }

        }
        $data = Calculator::find($request->id);
        
       return view('Admin.edit-cal', compact('data'));
    }

    public function readmore(Request $request)
    {
        if ($request->action == 'readmore') {
            if ($request->isMethod('post')) {
                $request->validate([
                    'status' => 'required'
                ]);
    
                
    
             Order::where(['id' => $request->id])->update(['status' => $request->status]);
    
               
             return back()->with('success', 'Updated Successfully');
            }
            $orders = Order::find($request->id);
        }
    

       return view('Admin.readmore', compact('orders'));
    }
    public function add_blog(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'author' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'blog_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category' => 'required|string|in:popular,regular'
            ]);

            $image = $request->file('blog_img');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('blog_img'), $imageName);

            $blog = Blog::create([
                'author' => $request->author,
                'title' => $request->title,
                'content' => $request->content,
                'category' => $request->category,
                'blog_img' => $imageName
            ]);

            if ($blog) {
                return back()->with('success', 'Blog post created successfully');
            }

            return back()->with('error', 'Failed to create blog post. Please try again.');
        }

        return view('Admin.add-blog');
    }

    




    public function blog_admin(Request $request)
    {
        $blogs = Blog::all();
           
        
       return view('Admin.blog-admin', compact('blogs'));
    }


    public function edit_blog(Request $request)
    {
        if ($request->action == 'edit') {
            if ($request->isMethod('post')) {
                $request->validate([
                    'author' => 'required',
                    'title' => 'required',
                    'content' => 'required',
                    'category' => 'required'
                ]);
    
                
    
            $update=  Blog::where(['id' =>$request->id])->update(['author' => $request->author, 'title' => $request->title,
            'content' => $request->content, 'category' => $request->category]);
    
             if($update){

                 return back()->with('success', 'Updated Successfully');
                }  else{
                    
                    return back()->with('success', 'something went wrong');
             }
            }

        }
        $data = Blog::find($request->id);
           
        
       return view('Admin.edit-blog',compact('data'));
    }
    public function delete(Request $request, $id)
    {
         Blog::find($id);
    
        if ($request->isMethod("POST")){
            $deleted = Blog::where(["id" => $id])->delete();
            if($deleted){
                return redirect("blog-admin");   
            }
        }
        return view("delete");
    }

    public function edit_blog_api(Request $request)
    {
        
            if ($request->isMethod('PUT')) {
                $request->validate([
                    'author' => 'required',
                    'title' => 'required',
                    'content' => 'required',
                    'category' => 'required',
                    'id' => 'required'
                ]);

                
                $update=  Blog::where(['id' =>$request->id])->update(['author' => $request->author, 'title' => $request->title,
            'content' => $request->content, 'category' => $request->category]);

                if($update){

                    return response()->json(['msg' => "Blog Updated Successfully", "data" => $update]);
                }

             
               
            }
          

       
    }

    public function deleteBlog(Request $request, $id)
    {
        
           
             

                
                $update=  Blog::where(['id' =>$id])->delete();
                if($update){
                    
                    $data = Blog::all();

                    return response()->json(['msg' => "Blog Delete Successfully", "data" => $data]);
             

             
               
            }
          

       
    }

    public function add_blog_api(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'author' => 'required',
                'title' => 'required',
                'content' => 'required',
                'blog_img' => 'required',
                'category' => 'required'
            ]);

            
            $save = Blog::Create($request->all());

            if($save){

                return response()->json(['msg' => "Blog save Successfully", "data" => $save]);
            }

         
           
        }
    }



    


    


}
