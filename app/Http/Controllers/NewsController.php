<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Http\Traits\TJsonResponse;
use App\Http\Traits\Utils;
use App\Models\News;
use App\Models\Rubric;
use App\Models\Author;

class NewsController extends Controller
{
    //
    use TJsonResponse;
    public function index(){
        $news = News::query()->get();
        return $this->successResponse(Utils::$MESSAGE_GET_NEWS,$news);
    }

    public function create(Request $request){
       $author = $request->get('author');
       $rubric = $request->get('rubric');
       $title = $request->get('title');
    
        //check author
       if(Author::where('full_name', $author)->get() === null){
        $authorId = Author::where('full_name', $author)->pluck('id');  
       }else{
        $timeVariable = Author::firstOrCreate(['full_name' => $author]);
        $authorId = $timeVariable->id;
       }

       //check rubric
       if(Rubric::where('rubric',$rubric)->get() === null){
        $rubricId = Rubric::where('rubric', $rubric)->pluck('id');  
       }else{
        $timeRubric = Rubric::firstOrCreate(['rubric' => $rubric]);
        $rubricId = $timeRubric->id;
       }         
       
       
       //realize news
    if(News::where('title',$title)->get()->isEmpty()){
        $check = News::query()->create([
            'title' => $request->get('title'),
            'announcement' => $request->get('announcement'),
            'text' => $request->get('text'),
            'authorId' => $authorId,
            'rubricId' => $rubricId,
        ]);
        if($check){
            return $this->successResponse(Utils::$MESSAGE_ADD_NEWS,$request->get('title'));
        }else{
            return $this->failedResponse("Ошибка при добавление новости в база данных",501);
        }
    }else{
        return $this->successResponse("Такая новость уже есть");
         }
    }


    public function getInfo(News $news){
        return $this->successResponse(Utils::$MESSAGE_GET_NEWS_INFO,$news);
    }

    public function search(Request $request){
        $search = News::query()
        ->where('title', 'like', '%' . $request->get('search') . '%')
        ->get();

        if(count($search) != 0){
            $result = [
                "search"=>$request->get('search'),
                "result"=>$search
            ];
        return $this->successResponse(Utils::$MESSAGE_GET_NEWS_BY_SEARCH,$result);
         }else{
            return $this->failedResponse("Нет такая новость по названию: ".$request->get('search')."",404);
         }

}
}