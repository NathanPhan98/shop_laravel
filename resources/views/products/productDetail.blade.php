@extends('main')

@section('content')
    <div class="container p-t-150">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="/danh-muc/{{ $productDetail->menu_id }}-{{ Str::slug($productDetail->menu->name, '-') }}.html"
                class="stext-109 cl8 hov-cl1 trans-04">
                {{ $productDetail->menu->name }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ $productDetail->name }}
            </span>
        </div>
    </div>

    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"><button
                                    class="arrow-slick3 prev-slick3 slick-arrow" style=""><i class="fa fa-angle-left"
                                        aria-hidden="true"></i></button><button class="arrow-slick3 next-slick3 slick-arrow"
                                    style=""><i class="fa fa-angle-right" aria-hidden="true"></i></button></div>

                            <div class="slick3 gallery-lb slick-initialized slick-slider slick-dotted">
                                <div class="slick-list draggable">
                                    <div class="slick-track" style="opacity: 1; width: 1539px;">
                                        <div class="item-slick3 slick-slide slick-current slick-active"
                                            data-thumb="images/product-detail-01.jpg" data-slick-index="0"
                                            aria-hidden="false" tabindex="0" role="tabpanel" id="slick-slide10"
                                            aria-describedby="slick-slide-control10"
                                            style="width: 513px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
                                            <div class="wrap-pic-w pos-relative">
                                                <img src="{{ $productDetail->thumbnail }}" alt="IMG-PRODUCT">

                                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                    href="/template/images/product-detail-01.jpg" tabindex="0">
                                                    <i class="fa fa-expand"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $productDetail->name }}
                        </h4>

                        <span class="mtext-106 cl2">
                            {!! \App\Helpers\Helper::price($productDetail->price, $productDetail->price_sale) !!}
                        </span>

                        <p class="stext-102 cl3 p-t-23">
                            {{ $productDetail->name }}
                        </p>

                        <!--  -->
                        <div class="p-t-33">


                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <form action="/add-cart" method="post">
                                        @if($productDetail->price !== null)
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>
                                            
                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                            name="quantity" value="1">
                                            
                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                        
                                        <button  type="submit"
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                            Add to cart
                                        </button>
                                        @endif
                                        <input type="hidden" name="product_id" value="{{$productDetail->id}}">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                    data-tooltip="Add to Wishlist">
                                    <i class="zmdi zmdi-favorite"></i>
                                </a>
                            </div>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Google Plus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {{ $productDetail->content }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">


            <span class="stext-107 cl6 p-lr-25">
                Categories: {{ $productDetail->menu->name }}
            </span>
        </div>


        <section class="sec-relate-product bg0 p-t-45 p-b-105">
            <div class="container">
                <div class="p-b-45">
                    <h3 class="ltext-106 cl5 txt-center">
                        Related Products
                    </h3>
                </div>

                <!-- Slide2 -->
                <div class="wrap-slick2">
                    <button class="arrow-slick2 prev-slick2 slick-arrow slick-disabled" aria-disabled="true"
                        style=""><i class="fa fa-angle-left" aria-hidden="true"></i>
                    </button>
                    <div class="slick2 slick-initialized slick-slider">
                        @foreach ($relatedProduct as $item)
                            <div class="slick-list draggable">
                                <div class="slick-track"
                                    style="opacity: 1; width: 2400px; transform: translate3d(0px, 0px, 0px);">
                                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15 slick-slide slick-current slick-active"
                                        data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 300px;">
                                        <div class="block2">
                                            <div class="block2-pic hov-img0">
                                                <img src="{{ $item->thumbnail }}" alt="IMG-PRODUCT">

                                                <a href="#"
                                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
                                                    tabindex="0">
                                                    Quick View
                                                </a>
                                            </div>

                                            <div class="block2-txt flex-w flex-t p-t-14">
                                                <div class="block2-txt-child1 flex-col-l ">
                                                    <a href="product-detail.html"
                                                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6"
                                                        tabindex="0">
                                                        {{ $item->name }}
                                                    </a>

                                                    <span class="stext-105 cl3">
                                                        {!! \App\Helpers\Helper::price($item->price, $item->price_sale) !!}
                                                    </span>
                                                </div>

                                                <div class="block2-txt-child2 flex-r p-t-3">
                                                    <a href="#"
                                                        class="btn-addwish-b2 dis-block pos-relative js-addwish-b2"
                                                        tabindex="0">
                                                        <img class="icon-heart1 dis-block trans-04"
                                                            src="/template/images/icons/icon-heart-01.png" alt="ICON">
                                                        <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                                            src="/template/images/icons/icon-heart-02.png" alt="ICON">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        @endforeach
                    </div>
                    <button class="arrow-slick2 next-slick2 slick-arrow" aria-disabled="false" style=""><i
                            class="fa fa-angle-right" aria-hidden="true"></i></button>
                </div>

        </section>
    </section>
@endsection
