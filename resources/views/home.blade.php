@extends('layouts.app')

@section('content')
    <form action="home" method="get">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-4">
                <p>Working on button click</p>
                <div class="input-group mb-3">
                    <input id="search" class="form-control" placeholder="Search Book..." aria-label="Search Book" aria-describedby="basic-addon2" name="searchText">
                    <div class="input-group-append">
                      <button class="btn btn-outline-primary" type="submit">Search</button>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <p>Select Search -</p>
                <div class="input-group mb-3">
                    <input id="" class="form-control js-example-basic-single" placeholder="Search Book..." aria-label="Search Book" aria-describedby="basic-addon2">
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
                    <img class="card-img-top" src="{{$book['image']}}" alt="Card image cap"
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
	var route = "{{ url('autocomplete-search') }}";
    var select2 = $('.js-example-basic-single').select2({
        minimumInputLength: 1,
        tags: [],
        minimumResultsForSearch: -1,
        ajax: {
            type: "get",
            url: route, // path to function
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            cache: false,
            data: function (params) {
                var query = {
                    query: params.term,
                    type: 'public'
                }
            // Query parameters will be ?search=[term]&type=public
            return query;
            },
            processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                var jsonArr = [];
                if(typeof data[0]['title'] !== 'undefined') {
                    for (var i=0; i<data.length; i++) {
                        jsonArr.push({id: data[i]['id'],text: data[i]['title']});
                    }
                }else{
                    for (var i=0; i<data.length; i++) {
                        jsonArr.push({id: data[i]['bid'],text: data[i]['book_name']});
                    }
                }
                console.log(jsonArr);
                return {
                    results: jsonArr
                };
            }
        }
    });

    select2.onSelect = (function(fn) {
        return function(data, options) {
            var target;
            
            if (options != null) {
                target = $(options.target);
            }
            
            if (target && target.hasClass('info')) {
                alert('click!');
            } else {
                return fn.apply(this, arguments);
            }
        }
    })(select2.onSelect);
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

</script>
@endsection