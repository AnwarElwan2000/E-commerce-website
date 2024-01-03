<!DOCTYPE html>
<html lang="en">

<head>

    @include('Admin.css')
    <style>
        .update_pro {
            text-align: center;
            padding-top: 40px;
        }

        .update_pro .head_pro {
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

        .old_image {
            width: 250px;
            height: 250px;
            margin-left: 200px;
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
                <div class="update_pro">
                    <h1 class="head_pro text-muted">Edit Product</h1>

                    <form class="w-50 form_pro" action="{{ url('edit_product_confirm', $update_product->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="title">Product Title</label>
                            <input type="text" value="{{ $update_product->title }}" name="title" required
                                class="form-control" id="title">
                        </div>

                        <div class="form-group">
                            <label for="description">Product Description</label>
                            <input type="text" value="{{ $update_product->description }}" required name="description"
                                class="form-control" id="description">
                        </div>

                        <div class="form-group">
                            <label for="price">Product Price</label>
                            <input type="number" value="{{ $update_product->price }}" required min="1"
                                name="price" class="form-control" id="price">
                        </div>

                        <div class="form-group">
                            <label for="quantity">Product Quantity</label>
                            <input type="number" value="{{ $update_product->quantity }}" required min="0"
                                name="quantity" class="form-control" id="quantity">
                        </div>

                        <div class="form-group">
                            <label for="discount_price">Discount Price</label>
                            <input type="number" min="0" value="{{ $update_product->discount_price }}" required
                                name="discount_price" class="form-control" id="discount_price">
                        </div>

                        <div class="form-group">
                            <label for="category">Product Category</label>
                            <select class="form-control form-control-lg" id="category" name="category" required>
                                @foreach ($category as $categoryes)
                                    <option value="{{ $categoryes->category_name }}"
                                        @if ($update_product->category == $categoryes->category_name) {{ 'selected' }} @endif>
                                        {{ $categoryes->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Current Product Image</label>
                            <img class="old_image" src="/Products_Images/{{ $update_product->image }}" alt="old_image">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Upload Image</label>
                            <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                        </div>

                        <button type="submit" class="btn btn-success w-100">Update Product</button>
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
