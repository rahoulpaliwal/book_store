@extends('layouts.app')

@section('title') 
    {{"Book Detail"}}
@endsection

@section('content')
<section class="section-pagetop ">
        <div class="container clearfix">
            <h2 class="title-page">{{ $books->book_name }}</h2>
        </div>
    </section>
    <section class="section-content bg padding-y border-top" id="site">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="row no-gutters">
                            <aside class="col-sm-5 border-right">
                                <article class="gallery-wrap">
                                        <div class="img-small-wrap">
                                        <img class="card-img-top" src="{{asset('images/'.$books->book_image)}}" alt="Card image cap" width="50px" height="250px">
                                        </div>
                                </article>
                            </aside>
                            <aside class="col-sm-7">
                                <article class="p-5">
                                    {{-- <h3 class="title mb-3">{{ $books->book_name }}</h3> --}}
                                    <dl class="row">
                                        <dt class="col-sm-3">Book Author</dt>
                                        <dd class="col-sm-9">{{ $books->book_author }}</dd>
                                        <dt class="col-sm-3">ISBN</dt>
                                        <dd class="col-sm-9">{{ $books->isbn }}</dd>
                                        <dt class="col-sm-3">Genre</dt>
                                        <dd class="col-sm-9">{{ $books->genre }}</dd>
                                    </dl>
                                    <div class="mb-3">
                                       
                                            <var class="price h3 text-success">
                                                <span class="currency">{{ config('settings.currency_symbol') }}</span><span class="num" id="productPrice">{{ $books->book_price }}</span>
                                            </var>
                                    </div>
                                    <hr>
                                    {{-- <form action="{{ route('product.add.cart') }}" method="POST" role="form" id="addToCart">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <dl class="dlist-inline">
                                                    @foreach($attributes as $attribute)
                                                        @php $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray()) @endphp
                                                        @if ($attributeCheck)
                                                            <dt>{{ $attribute->name }}: </dt>
                                                            <dd>
                                                                <select class="form-control form-control-sm option" style="width:180px;" name="{{ strtolower($attribute->name ) }}">
                                                                    <option data-price="0" value="0"> Select a {{ $attribute->name }}</option>
                                                                    @foreach($product->attributes as $attributeValue)
                                                                        @if ($attributeValue->attribute_id == $attribute->id)
                                                                            <option
                                                                                data-price="{{ $attributeValue->price }}"
                                                                                value="{{ $attributeValue->value }}"> {{ ucwords($attributeValue->value . ' +'. $attributeValue->price) }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </dd>
                                                        @endif
                                                    @endforeach
                                                </dl>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <dl class="dlist-inline">
                                                    <dt>Quantity: </dt>
                                                    <dd>
                                                        <input class="form-control" type="number" min="1" value="1" max="{{ $product->quantity }}" name="qty" style="width:70px;">
                                                        <input type="hidden" name="productId" value="{{ $product->id }}">
                                                        <input type="hidden" name="price" id="finalPrice" value="{{ $product->sale_price != '' ? $product->sale_price : $product->price }}">
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Add To Cart</button>
                                    </form> --}}
                                </article>
                            </aside>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <article class="card mt-4">
                        <div class="card-body">
                        Publication Date: {!!  $books->publication_date !!}
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
