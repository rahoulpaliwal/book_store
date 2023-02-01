<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['searchText'])){
            $searchText = $_GET['searchText'];
            $books = book::where('book_name','LIKE','%'.$searchText.'%')->get();
            if($books->isEmpty()){
                $books = [];
                $data = Http::withOptions(['verify' => false])->get('https://fakerapi.it/api/v1/books?_quantity=100')->json();
                //$data = file_get_contents(storage_path() . '/apiResponses/books.json');
                $dataArray = json_decode($data,true);
                foreach($dataArray['data'] AS $index=>$json) {
                    if(Str::contains(strtolower($json['title']), strtolower($searchText))) {
                        $books[] = $json;
                    }
                }
            }
            $books = $this->paginate($books);
            return view('home',compact('books'));
        }else{
            $data = Http::withOptions(['verify' => false])->get('https://fakerapi.it/api/v1/books?_quantity=100')->json();
            //$data = file_get_contents(storage_path() . '/apiResponses/books.json');
            $dataArray = json_decode($data,true);
            
            $books = book::all();
            $books = json_decode($books,true);
            $books = $this->paginate(array_merge($books,$dataArray['data']));
        }
        return view('home',compact('books'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function details($id)
    {
        $books = book::find($id);
        if(!$books){
            $data = file_get_contents(storage_path() . '/apiResponses/books.json');
            $dataArray = json_decode($data,true);

            foreach($dataArray['data'] AS $index=>$json) {
                if($json['id'] == $id) {
                    $books = $json;
                }
            }
        }
        return view('detailPage',['books'=>$books]);
        // return view('updateBook',['books'=>$books]);

        // $books = book::all();
    }

    public function searchHome(Request $request)
    {   
        if(isset($_GET['searchText'])){
            $searchText = $_GET['searchText'];
            // $books = DB::table('books')->where('book_name','LIKE','%'.$searchText.'%');
            $books = book::where('book_name','LIKE','%'.$searchText.'%');
            if($books->isEmpty()){
                //$data = Http::withOptions(['verify' => false])->get('https://fakerapi.it/api/v1/books?_quantity=100')->json();
                $data = file_get_contents(storage_path() . '/apiResponses/books.json');
                $dataArray = json_decode($data,true);

                foreach($dataArray['data'] AS $index=>$json) {
                    if(Str::contains(strtolower($json['title']), strtolower($searchText))) {
                        $books = $json;
                    }
                }
            }
            return view('home',['books'=>$books]);
        }
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            //$products=DB::table('products')->where('title','LIKE','%'.$request->search."%")->get();
            $books = book::where('book_name','LIKE','%'.$request->search."%")->get();
            if(!$books){
                //$data = Http::withOptions(['verify' => false])->get('https://fakerapi.it/api/v1/books?_quantity=100')->json();
                $data = file_get_contents(storage_path() . '/apiResponses/books.json');
                $dataArray = json_decode($data,true);

                foreach($dataArray['data'] AS $index=>$json) {
                    if(Str::contains($json['title'], $request->search)) {
                        $books = $json;
                    }
                }
            }
            return Response($books);
        }
    }
}
