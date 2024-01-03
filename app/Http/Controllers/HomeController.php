<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Product;

use App\Models\Cart;

use App\Models\Order;

use App\Models\Comment;

use App\Models\Reply;

use Session;

use Stripe;

use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
     public function index()
     {
          if(Auth::id())

          {
               return redirect('redirect');
          }

          else{

               $products = Product::paginate(3);
               $comment = Comment::orderby('id','desc')->get();
               $reply = Reply::all();
               return view('Home.user',compact('products','comment','reply'));

          }
      
     }

    public function redirect()
    {
         if(Auth::id())

         {

          $user_type = Auth::User()->user_type;

       if($user_type == '1')

       {    
          $total_product = Product::all()->count();
          $total_order = Order::all()->count();
          $total_user = User::all()->count();
          $total_customer = Order::all();
          $total_price = 0;

          foreach($total_customer as $total_customers)
          {
               $total_price += $total_customers->price;
          }

          $Order_Deliverd = Order::where('delivery_status','=','delivered')->get()->count();
          $Order_Processing = Order::where('delivery_status','=','processing')->get()->count();
          return view('Admin.home',compact('total_product','total_order','total_user','total_price','Order_Deliverd','Order_Processing'));
      
     }
       else{

            $products = Product::paginate(3);
            $comment = Comment::orderby('id','desc')->get();
            $reply = Reply::all();
            $user_id = Auth::User()->id;
            $cart_count = Cart::where('user_id',$user_id)->count();
            $order_count = Order::where('user_id',$user_id)->count();
            return view('Home.user',compact('products','comment','reply','cart_count','order_count'));

       }

         }

         else{

          return redirect()->back();

         }

    } 

    public function Product_details($id)
    {
   
     $Product_details = Product::find($id);
     return view('Home.Product_details',compact('Product_details'));

    }

    public function add_cart(Request $request , $id)
    {

      if(Auth::id())

      {
          $products_id = $id;
          $user_id = Auth::User()->id;
          $name = Auth::User()->name;
          $email = Auth::User()->email;
          $phone = Auth::User()->phone;
          $address = Auth::User()->address;
          $products = Product::find($id);
          $product_exist_id = Cart::where('product_id','=',$id)->where('user_id','=',$user_id)->get('id')->first();

         if($product_exist_id)

         {

          $cart = Cart::find($product_exist_id)->first();
          $quantity = $cart->quantity;
          $cart->quantity = $quantity + $request->quantity;

          if($products->discount_price != null)

          {
               $cart->price = $products->discount_price * $cart->quantity;
          }

          else{

               $cart->price = $products->price * $cart->quantity;
          }

          $cart->save();

          Alert::info('product added successfully','The order has been confirmed successfully');

          return redirect()->back();

         }

         else{

          $Cart = new Cart();
          $Cart->name = $name;
          $Cart->email = $email;
          $Cart->phone = $phone;
          $Cart->address = $address;
          $Cart->product_title = $products->title;
          $Cart->quantity = $request->quantity;

          if($products->discount_price)

          {
               $Cart->price = $products->discount_price * $request->quantity;
          }

          else{

               $Cart->price = $products->price * $request->quantity;
          }

          $Cart->image = $products->image;
          $Cart->product_id = $products_id;
          $Cart->user_id = $user_id;
          $Cart->save();
          return redirect()->back()->with('message','The order has been confirmed successfully');

      }
          
         }


      else{

          return redirect('login');
      }

    }

    public function show_cart()
    {

     if(Auth::id())

     {
          $user_id = Auth::User()->id;
          $Cart = Cart::where('user_id','=',$user_id)->get();
          return view('Home.cart',compact('Cart'));

     }

     else{

          return redirect('login');
     }


    }

    public function remove_product($id)
    {

      $remove_cart = Cart::find($id);
      $remove_cart->delete();
      return redirect()->back()->with('message','The shopping cart has been successfully deleted');

    }

    public function cash_order()
    {

       $user = Auth::User();
       $Cart = Cart::where('user_id','=',$user->id)->get();

       foreach ($Cart as $Carts) {

         $Order = new Order();
         $Order->name = $Carts->name;
         $Order->email = $Carts->email;
         $Order->phone = $Carts->phone;
         $Order->address = $Carts->address;
         $Order->user_id = $Carts->user_id;
         $Order->product_title = $Carts->product_title;
         $Order->quantity = $Carts->quantity;
         $Order->price = $Carts->price;
         $Order->image = $Carts->image;
         $Order->product_id = $Carts->product_id;
         $Order->payment_status = 'cash on delivery'; 
         $Order->delivery_status =  'processing';
         $Order->save();
         $cart_id = $Carts->id;
         $Cart = Cart::find($cart_id);
         $Cart->delete();

       }
      
       return redirect()->back()->with('message','The order was confirmed successfully');
       
      }

    public function stripe($total_price)

    {

     $total_price = $total_price;
     return view('Home.stripe',compact('total_price'));

    }


    public function stripePost(Request $request , $total_price)
    {
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $total_price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks For Payment" 
        ]);

       $user = Auth::User();
       $Cart = Cart::where('user_id','=',$user->id)->get();

       foreach ($Cart as $Carts) {

         $Order = new Order();
         $Order->name = $Carts->name;
         $Order->email = $Carts->email;
         $Order->phone = $Carts->phone;
         $Order->address = $Carts->address;
         $Order->user_id = $Carts->user_id;
         $Order->product_title = $Carts->product_title;
         $Order->quantity = $Carts->quantity;
         $Order->price = $Carts->price;
         $Order->image = $Carts->image;
         $Order->product_id = $Carts->product_id;
         $Order->payment_status = 'Paid'; 
         $Order->delivery_status =  'processing';
         $Order->save();
         $cart_id = $Carts->id;
         $Cart = Cart::find($cart_id);
         $Cart->delete();


       }
      
        Session::flash('success', 'Payment successful!');
        return back();

    }

    public function show_order()
    {

     if(Auth::id())

     {

     if(Auth::User()->user_type == 0)
     
     {

     $user_id = Auth::User()->id;
     $orders = Order::where('user_id','=',$user_id)->get();

     return view('Home.order',compact('orders'));

          }

          else{

               return redirect()->back();

          }
     }

     else{

          return redirect('login');

     }
   
    }

    public function cancel_order($id)
    {

       $cancel_order = Order::find($id);
       $cancel_order->delivery_status = 'You Canceled The Order';
       $cancel_order->save();
       return redirect()->back()->with('message','The order has been canceled successfully');

    }

    public function add_comment(Request $request)
    {

     if(Auth::id())
     {

     $comment = $request->comment;
     $add_comment = new Comment();
     $add_comment->name = Auth::User()->name;
     $add_comment->comment = $comment;
     $add_comment->user_id =  Auth::User()->id;
     $add_comment->save();
     return redirect()->back();

     }

     else{

          return redirect('login');
     }

     
    }

    public function reply_comment(Request $request)
    {

     if(Auth::id())

     {

          $comment_id = $request->commentId;
          $reply = $request->reply;
          $add_reply = new Reply();
          $add_reply->name = Auth::User()->name;
          $add_reply->comment_id = $comment_id;
          $add_reply->reply = $reply;
          $add_reply->user_id = Auth::User()->id;
          $add_reply->save();
          return redirect()->back();

     }

     else{

          return redirect('login');
     }
     

    }

    public function search(Request $request)
    {

     if(Auth::id())

     {

     $Search = $request->search;
     $products = Product::where('title','LIKE',"%$Search%")->orWhere('category','LIKE',"%$Search%")->paginate(10);
     $comment = Comment::orderby('id','desc')->get();
     $reply = Reply::all();
     return view('Home.user',compact('products','comment','reply'));

     }

     else{

          return redirect('login');

     }


    }

    public function products()

    {

     $products = Product::paginate(3);
     $comment = Comment::orderby('id','desc')->get();
     $reply = Reply::all();
     return view('Home.all_product',compact('products','comment','reply'));

    }

    public function search_product(Request $request)

    {
     
     if(Auth::id())
     {

     $Search = $request->search;
     $products = Product::where('title','LIKE',"%$Search%")->orWhere('category','LIKE',"%$Search%")->paginate(10);
     $comment = Comment::orderby('id','desc')->get();
     $reply = Reply::all();
     return view('Home.all_product',compact('products','comment','reply'));

     }

     else{

          return redirect('login');
          
     }

    }

}
