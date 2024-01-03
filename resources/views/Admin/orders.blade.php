<!DOCTYPE html>
<html lang="en">

<head>

    @include('Admin.css')
    <style>
        .head_order {
            text-align: center;
            padding: 50px;
            font-size: 40px;
            font-family: initial;
        }

        .order_table {
            width: 50%;
            margin: auto;
            margin-top: 25px;
            margin-bottom: 50px;
        }

        .order_image {
            width: 50px;
            height: 40px;
        }

        .div_search {
            margin-left: 520px;
            padding-bottom: 20px;
        }

        .div_search .search {
            color: #000;
        }
    </style>

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->

        @include('Admin.sidebare')

        <!-- partial -->


        @include('Admin.header')

        <!-- partial -->

        <div class="main-panel">
            <div class="content-wrapper">
                <h1 class="head_order text-muted">All Orders</h1>

                <div class="div_search">
                    <form action="{{ url('order_search') }}" method="GET">
                        @csrf
                        @method('GET')
                        <input type="search" class="search" name="search" placeholder="Search...">
                        <input type="submit" value="Search" class="btn btn-outline-success">
                    </form>
                </div>

                <table cellpadding="10" cellspacing='0' class="text-center table-sm table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-light text-dark">Name</th>
                            <th scope="col" class="bg-light text-dark">Email</th>
                            <th scope="col" class="bg-light text-dark">Phone</th>
                            <th scope="col" class="bg-light text-dark">Address</th>
                            <th scope="col" class="bg-light text-dark">Product Title</th>
                            <th scope="col" class="bg-light text-dark">Quantity</th>
                            <th scope="col" class="bg-light text-dark">Price</th>
                            <th scope="col" class="bg-light text-dark">Payment Status</th>
                            <th scope="col" class="bg-light text-dark">Delivery Status</th>
                            <th scope="col" class="bg-light text-dark">Image</th>
                            <th scope="col" class="bg-light text-success">Delivered</th>
                            <th scope="col" class="bg-light text-dark">Print PDF</th>
                            <th scope="col" class="bg-light text-primary">Send Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr align="center">
                                <th scope="row">{{ $order->name }}</th>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->product_title }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->delivery_status }}</td>
                                <td>
                                    <img class="order_image" src="/Products_Images/{{ $order->image }}"
                                        alt="order_image">
                                </td>


                                <td>
                                    @if ($order->delivery_status == 'processing')
                                        <a onclick="return confirm('Are you sure the product will be delivered?')"
                                            href="{{ url('delivered', $order->id) }}"
                                            class="btn btn-success">Delivered</a>
                                    @else
                                        <p class="text-success">Delivered</p>
                                    @endif

                                </td>

                                <td><a href="{{ url('print_pdf', $order->id) }}" class="btn btn-secondary">Print PDF</a>
                                </td>
                                <td><a href="{{ url('send_email', $order->id) }}" class="btn btn-primary btn-sm">Send
                                        Email</a></td>
                            </tr>
                        @empty

                            <div>
                                <p class="bg-danger text-center mb-2">No Data</p>
                            </div>
                        @endforelse
                    </tbody>
                </table>


            </div>
        </div>



        <!-- container-scroller -->
        <!-- plugins:js -->

        @include('Admin.script')

        <!-- End custom js for this page -->
</body>

</html>
