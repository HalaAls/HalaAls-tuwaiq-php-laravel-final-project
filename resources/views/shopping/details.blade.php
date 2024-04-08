@extends('layouts.app')
@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row gx-5">
                <aside class="col-lg-6">
                    <div class="border rounded-4 mb-3 d-flex justify-content-center">
                        <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image"
                            href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp">
                            <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit"
                                src="\assets\images\{{ $data->image }}" alt='{{ $data->image }}' />
                        </a>
                    </div>
                    {{-- <div class="d-flex justify-content-center mb-3">
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image"
                            href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big1.webp"
                            class="item-thumb">
                            <img width="60" height="60" class="rounded-2"
                                src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big1.webp" />
                        </a>
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image"
                            href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big2.webp"
                            class="item-thumb">
                            <img width="60" height="60" class="rounded-2"
                                src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big2.webp" />
                        </a>
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image"
                            href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big3.webp"
                            class="item-thumb">
                            <img width="60" height="60" class="rounded-2"
                                src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big3.webp" />
                        </a>
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image"
                            href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big4.webp"
                            class="item-thumb">
                            <img width="60" height="60" class="rounded-2"
                                src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big4.webp" />
                        </a>
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image"
                            href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp"
                            class="item-thumb">
                            <img width="60" height="60" class="rounded-2"
                                src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp" />
                        </a>
                    </div> --}}
                    <!-- thumbs-wrap.// -->
                    <!-- gallery-wrap .end// -->
                </aside>
                <main class="col-lg-6">
                    <div class="ps-lg-3">
                        <h4 class="title text-dark">
                            {{ $data->product_name }} <br />
                            {{ $data->category }} </h4>
                        <div class="d-flex flex-row my-3">
                            <div class="text-warning mb-1 me-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="ms-1">
                                    4.5
                                </span>
                            </div>
                            <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>154 orders</span>
                            <span class="text-success ms-2">In stock</span>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted text-danger"> <del>${{ $data->total }}</del></span>
                            <span class=" h5 "> ${{ $data->net }}</span>
                        </div>
                        <p>
                            {{ $data->description }}
                        </p>
                        <hr />
                        <form action="{{ route('addtocart', ['id' => $data->id]) }}" method="post">
                            @csrf
                            <div class="row mb-4">
                                <!-- col.// -->
                                <div class="col-md-4 col-6 mb-3">
                                    <label class="mb-2 d-block">{{ __('messages.Quantity') }}</label>
                                    <div class="input-group mb-3" style="width: 170px;">
                                        <button class="btn btn-white border border-secondary px-3" type="button"
                                            id="button-addon1" data-mdb-ripple-color="dark">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="text" name="qty" value="1"
                                            class="form-control text-center border border-secondary" placeholder="1"
                                            aria-label="Example text with button addon" aria-describedby="button-addon1" />
                                        <button class="btn btn-white border border-secondary px-3" type="button"
                                            id="button-addon2" data-mdb-ripple-color="dark">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary shadow-0"><i
                                    class="me-1 fa fa-shopping-basket"></i>
                                {{ __('messages.AddToCart') }}</button>

                            <a href="#" class="btn btn-warning shadow-0">{{ __('messages.BuyNow') }}</a>
                            {{-- <a href="{{ route('addtocart', ['id' => $data->id]) }}" class="btn btn-primary shadow-0"> <i
                                    class="me-1 fa fa-shopping-basket"></i>
                                {{ __('messages.AddToCart') }}</a> --}}
                            <a href="#" class="btn btn-light border border-secondary py-2 icon-hover px-3"> <i
                                    class="me-1 fa fa-heart fa-lg"></i> {{ __('messages.Like') }} </a>
                        </form>



                    </div>
                </main>
            </div>
        </div>
    </section>
    <!-- content -->
@endsection
