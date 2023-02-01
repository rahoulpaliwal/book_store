@extends('layouts.app')

@section('content')
    <form action="home" method="get">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" id="search" class="form-control" placeholder="Search Book..." aria-label="Search Book" aria-describedby="basic-addon2" name="searchText">
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
                    @if(isset($book['book_image']))
                    <img class="card-img-top" src="{{asset('images/'.$book['book_image'])}}" alt="Card image cap"
                        width="100px" height="250px">
                    @else
                    <img class="card-img-top" src="{{$books['image']}}" alt="Card image cap"
                        width="100px" height="250px">
                    @endif
                    <div class="card-body">
                        @if(isset($book['book_name']))
                        <h5 class="card-title"><strong><a href="/home/book-details/{{$book['bid']}}">{{$book['book_name']}}</a></strong></h5>
                        <p class="card-text">{{$book['book_author']}}</p>
                        <h2 class="card-text">{{"$".$book['book_price']}}</h2>
                        @else
                        <h5 class="card-title"><strong><a href="/home/book-details/{{$book['id']}}">{{$book['title']}}</a></strong></h5>
                        <p class="card-text">{{$book['author']}}</p>
                        <h2 class="card-text"></h2>
                        @endif
                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                    </div>
                </div>
    
            </div>
            
        @endforeach
        {{ $books->links('pagination::bootstrap-4') }}
    </div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
        $("#search-box").keyup(function() {
            $(".img-url").show();
            $.ajax({
                type : "POST",
                url : "ajax-endpoint/get-search-result.php",
                data : 'keyword=' + $(this).val(),
                success : function(data) {
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(data);
                    $("#search-box").css("background", "#FFF");

                }
            });
        });
    });
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

</script>
@endsection