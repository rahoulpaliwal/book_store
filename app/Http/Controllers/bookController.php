<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book;
use Illuminate\Support\Facades\DB;


class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {   
        if(isset($_GET['searchText'])){
            $searchText = $_GET['searchText'];
            // $books = DB::table('books')->where('book_name','LIKE','%'.$searchText.'%');
            $books = book::where('book_name','LIKE','%'.$searchText.'%');
            return view('home',['books'=>$books]);
        }
    }

    public function index()
    {
        if(isset($_GET['searchText'])){
            $searchText = $_GET['searchText'];
            $books = book::where('book_name','LIKE','%'.$searchText.'%')->get();
            return view('books',['books'=>$books]);
        }else{
            //$data = Http::get('https://fakerapi.it/api/v1/books?_quantity=100')->json();
            $books = book::all();
        }
        
        return view('books',['books'=>$books]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $b1 = new book;
        $b1->book_name = $request->book_title;
        $b1->book_price = $request->book_price;
        $b1->book_author = $request->book_author;
        $b1->isbn = $request->isbn;
        $b1->publication_date = $request->publication_date;
        $b1->genre = $request->genre;
        if($request->hasfile('book_image')){
            $file = $request->file('book_image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().".".$ext;
            $file->move('images/',$filename);
            $b1->book_image = $filename;
        }

        $b1->save();
        return redirect('books');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $books = book::all();
        // return view('books',['books'=>$books]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $books = book::find($id);
        return view('updateBook',['books'=>$books]);
        // return view('updateBook',['books'=>$books]);

        // $books = book::all();
    }

    public function details($id)
    {
        $books = book::find($id);
        return view('detailPage',['books'=>$books]);
        // return view('updateBook',['books'=>$books]);

        // $books = book::all();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $books=book::find($id);
        $books->book_name = $request->book_title;
        $books->book_price = $request->book_price;
        $books->book_author = $request->book_author;
        $books->isbn = $request->isbn;
        $books->genre = $request->genre;
        $books->publication_date = $request->publication_date;
        $books->save();
        return redirect('books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $b = book::find($id);
        $b->delete();
        return redirect('books');
    }

}
