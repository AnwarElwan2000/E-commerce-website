<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Category;

use App\Models\Product;

use App\Models\Order;

use PDF;

use Notification;

use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    public function view_category()
    {
        if(Auth::id()){

            if(Auth::User()->user_type == '1')

            {
                $category = Category::all();
                return view('Admin.category',compact('category'));
            }

            else{

                return redirect()->back();

                }
        }
        else{

            return redirect('login');

        }
    }

    public function add_category(Request $request)
    {
        if(Auth::id())
        {
            if(Auth::User()->user_type == '1')

        {

        if($request->name)
        
        {

            $add_category = new Category();
            $add_category->category_name = $request->name;
            $add_category->save();
            return redirect()->back()->with('message','The category has been added successfully');

        }
        else{

            return redirect()->back();

        }

            }

        else{

                return redirect()->back();

            }
        }
        else{

            return redirect('login');

        }

    

    }

    public function delete_category($id)
    {
       if(Auth::id())
       {

        if(Auth::User()->user_type == '1')

        {
           $delete_category = Category::find($id);
           $delete_category->delete();
           return redirect()->back()->with('message','The category has been successfully deleted');

        }
        else{

            return redirect()->back();

        }

       }
       else{

        return redirect('login');

       }
    
       }

    public function view_product()
    {
       if(Auth::id())

       {

        if(Auth::User()->user_type == '1')

        {
            $Category = Category::all();
            return view('Admin.products',compact('Category'));

        }
        else{

            return redirect()->back();

        }

       }

       else{

        return redirect('login');

       }
    }

    public function add_product(Request $request)
    {
        if(Auth::id())

        {
            if(Auth::User()->user_type =='1')

            {

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price	 = $request->discount_price;

       if($request->hasfile('image'))

       {

         $img = $request->file('image');
         $image_name = time() . '.' . $img->getClientOriginalExtension();
         $request->file('image')->move('Products_Images',$image_name);
         $product->image = $image_name;

       }

       $product->save();

       return redirect()->back()->with('message','The product has been added successfully');


    }

    else{

        return redirect()->back();
     }

    }

      else{

        return redirect('login');

    }
       

    }

    public function show_product()
    {
        if(Auth::id())
        {
            if(Auth::User()->user_type == '1')

            {
                $products = Product::all();
                return view('Admin.view_products',compact('products'));

            }

            else{

                return redirect()->back();

            }
        }

        else{

            return redirect('login');

        }
    }

    public function delete_product($id)
    {
        if(Auth::id())
        {
            if(Auth::User()->user_type == '1')

            {

               $delete_product = Product::find($id);
               $delete_product->delete();
               return redirect()->back()->with('message','The product has been successfully deleted');


            }
            else{
                
                return redirect()->back();
            }
        }

        else{

            return redirect('login');

        }
    }

    public function update_product($id)
    {
        if(Auth::id())

        {

            if(Auth::User()->user_type == '1')

            {

                $update_product = Product::find($id);
                $category = Category::all();
                return view('Admin.update_product',compact('update_product','category'));
                
            }
            else{

                return redirect()->back();

            }
        }

        else{

            return redirect('login');

        }
    }
    
    public function edit_product_confirm(Request $request,$id)
    {
        if(Auth::id())

        {

            if(Auth::User()->user_type == '1')

            {

                $edit_product = Product::find($id);
                $edit_product->title = $request->title;
                $edit_product->description = $request->description;
                $edit_product->category = $request->category;
                $edit_product->quantity = $request->quantity;
                $edit_product->price = $request->price;
                $edit_product->discount_price = $request->discount_price;
         
                if($request->hasfile('image'))

                {
         
                 $img = $request->file('image');
                 $image_name = time() . '.' . $img->getClientOriginalExtension();
                 $request->file('image')->move('Products_Images',$image_name);
                 $edit_product->image = $image_name;

                 
                }
         
                $edit_product->save();
                return redirect()->back()->with('message','The product has been modified successfully');
   

            }
            else{

                return redirect()->back();

            }
        }
        else{
            
            return redirect('login');

        }
       

    }

    public function orders()
    {
        if(Auth::id())

        {
            if(Auth::User()->user_type == '1')
            {

                $orders = Order::all();
                return view('Admin.orders',compact('orders'));

            }
            else{

                return redirect()->back();

            }
        }
        else
        {

            return redirect('login');

        }
       
    }

    public function delivered($id)
    {
        if(Auth::id())

        {
            if(Auth::User()->user_type == '1')

            {
                $delivered = Order::find($id);
                $delivered->delivery_status = 'delivered';
                $delivered->payment_status = 'paid';
                $delivered->save();
                return redirect()->back();

            }

            else{
                return redirect()->back();

            }
        }
        else{
            
            return redirect('login');

        }
      
    }

    public function print_pdf($id)
    {
        if(Auth::id())

        {
            if(Auth::User()->user_type == '1')

            {
                $order = Order::find($id);
                $pdf = PDF::loadView('Admin.pdf',compact('order'));
                return $pdf->download('Order_details.pdf');

            }
            else{

                return redirect()->back();

            }
        }
        else{

            return redirect('login');

        }
        
    }

    public function send_email($id)
    {
        if(Auth::id())

        {
            if(Auth::User()->user_type == '1')

            {

                $order = Order::find($id);
                return view('Admin.send_email',compact('order'));

            }
            else{

                return redirect()->back();

            }
        }
        
        else{

            return redirect('login');

        }
       
    }

    public function send_email_user(Request $request , $id)
    {
        if(Auth::id())

        {
            if(Auth::User()->user_type == '1')

            {
                $order = Order::find($id);

                $Details = [
                    'greeting' => $request->greeting,
                    'first_line' => $request->first_line,
                    'body' => $request->body,
                    'button' => $request->button_name,
                    'url' => $request->url,
                    'last_line' => $request->last_line,
                ];
        
                Notification::send($order, new SendEmailNotification($Details));

                return redirect()->back();

                    }

                    else{
                        return redirect()->back();

                    }
                }
                else{

                    return redirect('login');

                }
    }

    public function order_search(Request $request)
    {
        if(Auth::id())

        {
            if(Auth::User()->user_type == '1')

            {
                if($request->search)
                {

                $Search = $request->search;
                $orders = Order::where('name','LIKE',"%$Search%")->orWhere('phone','LIKE',"%$Search%")->orWhere('product_title','LIKE',"%$Search%")->get();
                return view('Admin.orders',compact('orders'));
        
                }
                else{

                   return redirect('orders');

                }
            }

            else{

                return redirect()->back();

            }
        }
        else{

            return redirect('login');

        }
     

    }
}

