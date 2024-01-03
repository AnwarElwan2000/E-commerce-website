<!DOCTYPE html>
<html lang="en">

<head>

    @include('Admin.css')
    <style>
        .show_pro {
            text-align: center;
            padding-top: 40px;
        }

        .show_pro .head_pro {
            font-size: 40px;
            padding-bottom: 40px;
        }

        #table_pro {
            margin-left: 200px;
        }

        .products_image {
            width: 250px;
            height: 250px;
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
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="show_pro">
                    <h1 class="head_pro text-muted">All Products</h1>
                    <table class="table table-bordered w-50 text-light" id="table_pro">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-dark" scope="col">ID</th>
                                <th class="text-dark" scope="col">Product Title</th>
                                <th class="text-dark" scope="col">Description</th>
                                <th class="text-dark" scope="col">Category</th>
                                <th class="text-dark" scope="col">quantity</th>
                                <th class="text-dark" scope="col">Price</th>
                                <th class="text-dark" scope="col">Descount Price</th>
                                <th class="text-dark" scope="col">Product Image</th>
                                <th class="text-success" scope="col">Edit</th>
                                <th class="text-danger" scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($products as $product)
                                <tr align="center">
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->discount_price }}</td>
                                    <td>
                                        @if ($product->image == null)
                                            <span class="text-muted">Image Null</span>
                                        @else
                                            <img class="products_image" src="/Products_Images/{{ $product->image }}"
                                                alt="product_image">
                                    </td>
                                    <td><a title="edit" href="{{ url('update_product', $product->id) }}"
                                            class="btn btn-outline-success">Edit</a></td>
                                    <td><a onclick="return confirm('Are you sure you want to delete the product?')"
                                            title="delete" href="{{ url('delete_product', $product->id) }}"
                                            class="btn btn-outline-danger">Delete</a></td>
                            @endif
                            </tr>
                            @php
                                $i++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->

        @include('Admin.script')

        <!-- End custom js for this page -->
</body>

</html>
