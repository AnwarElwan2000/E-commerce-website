<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>


            <div class="div_search">
                <form action="{{ url('search') }}" method="get">
                    @csrf
                    @method('GET')
                    <input class="input_search" type="text" name="search" placeholder="Search For Something...">
                    <button id="input_submit" type="submit" class="btn btn-outline-primary">Search</button>
                </form>
            </div>



        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="row">
            @forelse ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ url('Product_details', $product->id) }}" class="option1">
                                    Product Details

                                </a>
                                <form action="{{ url('add_cart', $product->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="number" class="btn-sm" min="1" value="1" name="quantity"
                                        class="quantity" style="width: 100px;margin-left:40px;margin-top:10px;">
                                    <input type="submit" value="Add To Cart">
                                </form>
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="/Products_Images/{{ $product->image }}" alt="product_image">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $product->title }}
                            </h5>
                            @if ($product->discount_price != null)
                                <h6 class="text-danger">
                                    <small> Dicount Price :</small>
                                    <br>
                                    ${{ $product->discount_price }}
                                </h6>
                                <h6 style="text-decoration: line-through;color:blue">
                                    <small>Price : </small>
                                    <br>
                                    ${{ $product->price }}
                                </h6>
                            @else
                                <h6 style="color: blue;">
                                    <small> Price : </small>
                                    <br>
                                    ${{ $product->price }}
                                </h6>
                            @endif

                        </div>
                    </div>
                </div>
            @empty

                <div class="div_data">
                    <p class="alert alert-danger">There are no results to display</p>
                </div>
            @endforelse
            <span class="paginate">
                {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
            </span>


        </div>
</section>
