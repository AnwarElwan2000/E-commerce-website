<!DOCTYPE html>
<html lang="en">

<head>

    @include('Admin.css')
    <style>
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .div_center .head {
            font-size: 50px;
            padding-bottom: 40px;
        }

        #Category {
            color: white;
        }

        .div_center .form {
            margin-left: 325px;
        }

        .table_mr {
            margin-bottom: 50px;
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

                <div class="div_center">
                    <h1 class="head text-muted">Add Category</h1>

                    <form class="w-50 form" action="{{ url('add_category') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="Category">Category Name</label>
                            <input required type="text" name="name" class="form-control" id="Category"
                                placeholder="Write Category Name">
                        </div>

                        <button type="submit" class="btn btn-outline-success">Add Category</button>
                    </form>
                </div>

                <table class="table table-bordered w-50 mt-5 mb-5 text-center text-light" align="center"
                    class="table_mr">
                    <thead>
                        <tr>
                            <th scope="col" class="text-light">ID</th>
                            <th scope="col" class="text-light">Category Name</th>
                            <th scope="col" class="text-primary">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($category as $name)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <th scope="row">{{ $name->category_name }}</th>
                                <th><a onclick="return confirm('Are you sure you want to delete the category?')"
                                        href="{{ url('delete_category', $name->id) }}"
                                        class="btn btn-outline-danger">Delete</a></th>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
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
