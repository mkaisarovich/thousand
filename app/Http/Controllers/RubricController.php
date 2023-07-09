<?php

namespace App\Http\Controllers;
use App\Http\Traits\TJsonResponse;
use App\Http\Traits\Utils;
use Illuminate\Http\Request;
use App\Models\Rubric;
use App\Models\News;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RubricController extends Controller
{
    //
    use TJsonResponse;
    public function index(){
        $rubrics = Rubric::query()->get();
        return $this->successResponse(Utils::$MESSAGE_GET_RUBRICS,$rubrics);
    }


    public function create(Request $request){
        $rubric = $request->get('rubric');
        if(Rubric::where('rubric', $rubric)->get()->isEmpty()){
            $check = Rubric::query()->create([
                'rubric' => $request->get('rubric'),
            ]);
            if($check){
                return $this->successResponse(Utils::$MESSAGE_ADD_RUBRIC);
            }else{
                return $this->failedResponse("Ошибка при добавление рубрику в база данных",200);
            }
           }else{
            return $this->successResponse("Такая рубрика существует");
             }
    }



    public function getInfo(Rubric $rubric){
      
      
        $info = News::query()
        ->select('news.*')
            ->join('rubrics', 'rubrics.id', '=', 'news.rubricId')
            ->where('rubrics.id', '=', $rubric->id)
            ->orWhere('rubrics.rubric', '=', $rubric->rubric)
            ->get();

        $rubricInfo = Rubric::query()
        ->select('id', 'rubric')
         ->where('id', '=', $rubric->id)
         ->first();

     
        $result = [
            'id' =>$rubricInfo->id,
            'name'=>$rubricInfo->rubric,
            'data'=>$info
        ];
        
        return $this->successResponse(Utils::$MESSAGE_GET_NEWS_BY_RUBRIC,$result);
    }


    public function search(Request $request){
        $search = News::query()
        ->join('rubrics', 'rubrics.id', '=', 'news.rubricId')
         ->where('rubrics.rubric', 'like', '%'.$request->get('search').'%')
         ->select('news.*')
         ->get();   
    // return count($search);
         if(count($search) != 0){
            $result = [
                "search"=>$request->get('search'),
                "result"=>$search
            ];
        return $this->successResponse(Utils::$MESSAGE_GET_RUBRIC_BY_SEARCH,$result);
         }else{
            return $this->failedResponse("Нет такая новость по названию: ".$request->get('search')."",404);
         }
    }

}
