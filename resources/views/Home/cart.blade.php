<!DOCTYPE html>
<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        .center {
            margin: auto;
            margin-bottom: 50px;
            width: 50%;
            text-align: center;
        }

        .center .cart {
            font-size: 70px;
            margin-top: 30px;
            margin-bottom: 30px;
            font-family: fantasy;
        }

        .cart_img {
            width: 70px;
            height: 70px;
            border-radius: 50px;
        }

        .Proceed {
            font-size: 25px;
            padding-bottom: 15px;
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')

    <div class="hero_area">
        <!-- header section strats -->

        @include('Home.header')
        <!-- end header section -->

        @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('message') }}
            </div>
        @endif


        <div class="center">
            <h1 class="text-muted cart">Cart</h1>

            <table class="table table-hover table-light text-center">
                <thead>
                    <tr>
                        <th scope="col" class="bg-dark text-light">Product Title</th>
                        <th scope="col" class="bg-dark text-light">Product Quantity</th>
                        <th scope="col" class="bg-dark text-light">Price</th>
                        <th scope="col" class="bg-dark text-light">Image</th>
                        <th scope="col" class="bg-dark text-light">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_price = 0;
                    @endphp
                    @foreach ($Cart as $Carts)
                        <tr align="center">
                            <th scope="row">{{ $Carts->product_title }}</th>
                            <td>{{ $Carts->quantity }}</td>
                            <td>{{ $Carts->price }}</td>
                            <td>
                                <img class="cart_img" src="/Products_Images/{{ $Carts->image }}" alt="cart_image">
                            </td>
                            <td><a onclick="confirmation(event)" title="remove product"
                                    href="{{ url('remove_product', $Carts->id) }}"
                                    class="btn btn-danger btn-sm">Remove</a></td>
                        </tr>
                        @php
                            $total_price += $Carts->price;
                        @endphp
                    @endforeach
                </tbody>
            </table>
            <h2 class="mt-5 mb-3 text-muted">Total Price : $ {{ $total_price }}</h2>


            <div>
                <h2 class="Proceed">Proceed Order</h2>
                <a href="{{ url('cash_order') }}" class="btn btn-danger">Cash On Delivery</a>
                <a href="{{ url('stripe', $total_price) }}" class="btn btn-danger">Pay Using Card</a>
            </div>




        </div>


        <!-- footer start -->


        <!-- footer end -->
        <div class="cpy_">
            <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

                Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

            </p>
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
