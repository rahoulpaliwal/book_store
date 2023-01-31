@extends('layouts.app')

@section('title') 
    {{"Update Book"}}
@endsection

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-4"></div>
        <div class="col-4">
            <h1 class="text-center">Update Book</h1>
            <form action="/books/update/{{$books->bid}}" method="POST">
                @csrf
                <input type="text" name="book_title" placeholder="Book Title" class="form-control my-2" value="{{$books->book_name}}">
                <input type="text" name="book_price" placeholder="Book Price" class="form-control my-2" value="{{$books->book_price}}">
                <input type="text" name="book_author" placeholder="Book Author" class="form-control my-2" value="{{$books->book_author}}">
                <input type="text" name="isbn" placeholder="ISBN" class="form-control my-2" value="{{$books->isbn}}">
                <input type="text" name="genre" placeholder="Genre" class="form-control my-2" value="{{$books->genre}}">
                <input type="date" name="publication_date" placeholder="Publication Date" class="form-control my-2" value="{{$books->publication_date}}">

                <div class="form-group">
                    <button class="btn btn-success">Update</button>
                </div>


            </form>

        </div>
        <div class="col-4"></div>


    </div>
</div>
@endsection
