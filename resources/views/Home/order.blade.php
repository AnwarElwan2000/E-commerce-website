<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
    <style>
        .div_order {
            width: 50%;
            margin: auto;
        }

        .div_order .head_order {
            font-size: 30px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        .div_order .img_order {
            width: 50px;
            height: 50px;
        }

        #message {
            width: 50%;
            margin-top: 20px;
        }
    </style>

</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->

        @include('Home.header')

        @if (session()->has('message'))
            <div class="alert alert-success" id="message">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="div_order">
            <h1 class="head_order">All Orders</h1>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Product Title</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Delivery Status</th>
                        <th scope="col">Image</th>
                        <th scope="col">Cancel Order</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr align="center">
                            <th scope="row">{{ $order->product_title }}</th>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>
                                @if ($order->delivery_status == 'You Canceled The Order')
                                    <span class="text-danger">
                                        Not Allowed
                                    </span>
                                @elseif($order->delivery_status == 'delivered')
                                    <span class="text-success">{{ $order->delivery_status }}</span>
                                @else
                                    <span class="text-primary">{{ $order->delivery_status }}</span>
                                @endif

                            </td>

                            <td>
                                <img class="img_order" src="/Products_Images/{{ $order->image }}" alt="">
                            </td>
                            <td><a onclick="return confirm('Are you sure to cancel the order?')"
                                    href="{{ url('cancel_order', $order->id) }}" class="btn btn-danger">Cancel</a></td>
                        </tr>
                    @empty

                        <div>
                            <p class="bg-danger text-light text-center p-1">There is no data to display</p>
                        </div>
                    @endforelse
                </tbody>
            </table>
        </div>




    </div>
    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>
