<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('Admin.css')

    <style>
        .head_email {
            text-align: center;
            padding-top: 50px;
            font-size: 25px;
            font-family: initial;
        }

        .form_email {
            margin: auto;
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .form_email #greeting,
        #firstline,
        #emailbody,
        #buttonname,
        #url,
        #lastline {
            background-color: #111;
            color: white;
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

                <h1 class="head_email text-muted">Send Email to {{ $order->email }}</h1>

                <form class="w-50 form_email" action="{{ url('send_email_user', $order->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email Greeting</label>
                        <input type="text" class="form-control" id="greeting" name="greeting"
                            placeholder="Email Greeting">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email First Line</label>
                        <input type="text" class="form-control" id="firstline" name="first_line"
                            placeholder="Email FirstLine">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email Body</label>
                        <input type="text" class="form-control" id="emailbody" name="body"
                            placeholder="Email Body">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email Button Name</label>
                        <input type="text" class="form-control" id="buttonname" name="button_name"
                            placeholder="Email Button Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email Url</label>
                        <input type="text" class="form-control" id="url" name="url"
                            placeholder="Email Url">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email Last Line</label>
                        <input type="text" class="form-control" id="lastline" name="last_line"
                            placeholder="Email Last Line">
                    </div>


                    <button type="submit" class="btn btn-success">Send Mail</button>
                </form>

            </div>
        </div>


        <!-- container-scroller -->
        <!-- plugins:js -->

        @include('Admin.script')

        <!-- End custom js for this page -->
</body>

</html>
