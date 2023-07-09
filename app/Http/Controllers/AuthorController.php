<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\TJsonResponse;
use App\Http\Traits\Utils;
use App\Models\Author;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    //
    use TJsonResponse;
    public function index(){
        $authors = Author::query()->get();
        return $this->successResponse(Utils::$MESSAGE_GET_AUTHORS,$authors);
    }

    public function create(Request $request){
        $author = $request->get('full_name');
        if(Author::where('full_name', $author)->get()->isEmpty()){
            $check = Author::query()->create([
                'full_name' => $request->get('full_name'),
                'email' => $request->get('email'),
            ]);
            if($check){
                return $this->successResponse(Utils::$MESSAGE_ADD_AUTHOR);
            }else{
                return $this->failedResponse("Ошибка при добавление автора в база данных",200);
            }
           }else{
            return $this->successResponse("Такой автор существует");
             }
    }

    public function getInfo(Author $author){
        
        $info = News::query()
        ->join('authors', 'news.authorId', '=', 'authors.id')
        ->select('news.*')
        ->where('authors.id', '=', $author->id)
        ->orWhere('authors.full_name', '=', $author->full_name)
        ->get();

        $authorInfo = Author::query()
        ->select('id', 'full_name')
         ->where('id', '=', $author->id)
         ->first();

     
        $result = [
            'id' =>$authorInfo->id,
            'name'=>$authorInfo->full_name,
            'data'=>$info
        ];

        return $this->successResponse(Utils::$MESSAGE_GET_NEWS_BY_AUTHOR,$result);
    }

}
