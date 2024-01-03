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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .paginate {
            padding-top: 20px;
            margin-left: 25px;
        }

        .head_comment {
            font-size: 30px;
            text-align: center;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .form_comment {
            width: 50%;
            margin: auto;
            padding-bottom: 30px;
        }

        .div_all_comment {
            padding-left: 20%;
        }

        .head_all_comment {
            font-size: 20px;
            padding-bottom: 20px;
        }

        .div_search {
            padding-top: 50px;
        }

        .div_search .input_search {
            width: 500px;
        }

        .div_search #input_submit {
            margin-left: 10px;
        }

        .div_data {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->

        @include('Home.header')

        <!-- end header section -->

        <!-- slider section -->


        <!-- end slider section -->






        <!-- product section -->

        @include('Home.product_view')


        {{-- Comment and Reply system Starts here   --}}

        <div>
            <h1 class="head_comment">Comments</h1>

            <form class="form_comment" action="{{ url('add_comment') }}" method="post">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Comments</label>
                    <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"
                        placeholder="Leave a comment here"></textarea>
                </div>

                <input type="submit" value="Comment">

            </form>
        </div>

        <div class="div_all_comment">
            <h1 class="head_all_comment">All Comments</h1>
            @foreach ($comment as $comments)
                <div>
                    <b>{{ $comments->name }}</b>
                    <p>{{ $comments->comment }}</p>
                    <a data-Comment_id="{{ $comments->id }}" href="javascript::void(0);" onclick="reply(this)">Reply</a>

                    @foreach ($reply as $replyes)
                        @if ($replyes->comment_id == $comments->id)
                            <div style="padding-left:3%;padding-bottom:10px; ">
                                <b class="text-muted">{{ $replyes->name }}</b>
                                <p class="text-muted">{{ $replyes->reply }}</p>
                                <a data-Comment_id="{{ $comments->id }}" href="javascript::void(0);"
                                    onclick="reply(this)">Reply</a>
                            </div>
                        @endif
                    @endforeach
                </div>



                <hr>
            @endforeach

            <div style="display:none;" class="reply_div">

                <form action="{{ url('reply_comment') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="text" name="commentId" id="commentId" hidden>
                    <textarea style="height: 100px; width:500px;" name="reply" placeholder="Write Something here"></textarea>
                    <br>
                    <button type="submit" class="btn btn-warning">Reply</button>
                    <a href="javascript::void(0)" class="btn btn-danger" onclick="reply_close(this)">Close</a>
                </form>

            </div>

        </div>




        {{-- Comment and Reply system end here   --}}



        <!-- end product section -->

        <!-- subscribe section -->


        <div class="cpy_">
            <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

                Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

            </p>
        </div>

        <script>
            function reply(caller) {
                document.getElementById('commentId').value = $(caller).attr('data-Comment_id');
                $('.reply_div').insertAfter($(caller));
                $('.reply_div').show();

            }

            function reply_close(close) {
                $('.reply_div').hide();
            }
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                var scrollpos = localStorage.getItem("scrollpos");
                if (scrollpos) window.scrollTo(0, scrollpos);
            });

            window.onscroll = function(e) {
                localStorage.setItem("scrollpos", window.scrollY);
            };
        </script>


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
