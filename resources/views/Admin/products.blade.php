<!DOCTYPE html>
<html lang="en">

<head>

    @include('Admin.css')
    <style>
        .div_pro {
            text-align: center;
            padding-top: 40px;
            margin-bottom: 50px;
        }

        .div_pro .head_pro {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .form_pro {
            margin-left: 325px;
        }

        #title,
        #description,
        #price,
        #quantity,
        #discount_price,
        #category {
            background-color: white;
            color: black;
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
                <div class="div_pro">
                    <h1 class="head_pro text-muted">Add Products</h1>

                    <form class="w-50 form_pro" action="{{ url('add_product') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="title">Product Title</label>
                            <input type="text" name="title" required class="form-control" id="title"
                                placeholder="Write a Title">
                        </div>

                        <div class="form-group">
                            <label for="description">Product Description</label>
                            <input type="text" required name="description" class="form-control" id="description"
                                placeholder="Write a Description">
                        </div>

                        <div class="form-group">
                            <label for="price">Product Price</label>
                            <input type="number" required min="1" name="price" class="form-control"
                                id="price" placeholder="Write a Price">
                        </div>

                        <div class="form-group">
                            <label for="quantity">Product Quantity</label>
                            <input type="number" required min="0" name="quantity" class="form-control"
                                id="quantity" placeholder="Write a Quantity">
                        </div>

                        <div class="form-group">
                            <label for="discount_price">Discount Price</label>
                            <input type="number" min="0" required name="discount_price" class="form-control"
                                id="discount_price" placeholder="Write a Discount Price">
                        </div>

                        <div class="form-group">
                            <label for="category">Product Category</label>
                            <select class="form-control form-control-lg" id="category" name="category" required>
                                <option selected>Select category...</option>
                                @foreach ($Category as $name)
                                    <option value="{{ $name->category_name }}">{{ $name->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Upload Image</label>
                            <input type="file" required name="image" class="form-control-file"
                                id="exampleFormControlFile1">
                        </div>

                        <button type="submit" class="btn btn-success w-100">Add Product</button>
                    </form>



                </div>
            </div>
        </div>

        <!-- container-scroller -->
        <!-- plugins:js -->

        @include('Admin.script')

        <!-- End custom js for this page -->
</body>

</html>
