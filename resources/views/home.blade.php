@extends('layouts.app')

@section('content')


    <form action="home" method="get">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Book..." aria-label="Search Book" aria-describedby="basic-addon2" name="searchText">
                    <div class="input-group-append">
                      <button class="btn btn-outline-primary" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </div>
    
    </form>
    <div class="row justify-content-center">
        @foreach ($books as $book)
           
            <div class="item">
                <div class="card mx-3 my-3 book_card" style="width: 13rem;">
                    <img class="card-img-top" src="{{asset('images/'.$book->book_image)}}" alt="Card image cap"
                        width="100px" height="250px">
                    <div class="card-body">
                        <h5 class="card-title"><strong><a href="/books/details/{{$book->bid}}">{{$book->book_name}}</a></strong></h5>
                        <p class="card-text">{{$book->book_author}}</p>
                        <h2 class="card-text">{{"$".$book->book_price}}</h2>
                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                    </div>
                </div>
    
            </div>
            
        @endforeach
        

    </div>

</div>
</div>
@endsection
