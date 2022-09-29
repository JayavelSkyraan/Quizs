<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;
use App\Models\Category;
use App\Models\Quiz;

class ApiController extends Controller
{
    public function appapi(Request $request){

     
         $request->appId= $request->input('appId');
        
            
         if(!empty($request->appId)){
        
            $resArr_list= App::find( $request->appId);  
    
                    if(isset($resArr_list->id) && !empty($resArr_list->id)){
            
                        $message = array('result' => '1', 'data'=> $resArr_list , "msg" => '');
                        
                    }else{
            
                        $message = array('result' => '0', 'data'=> '', "msg" => 'no data');
                            
                    }
                    
    
        }else{
            $message = array('result' => '0', 'data'=> 'App Id is missing!', "msg" => 'no data');
        
        }
    
        return response()->JSON($message);

   
}


public function categoryapi(Request $request){


$request->category_name= $request->input('category_name'); 
    if(!empty($request->category_name)){
        
        $resArr_list= Category::find($request->category_name);  

                if(isset($resArr_list->id) && !empty($resArr_list->id)){
        
                    $message = array('result' => '1', 'data'=> $resArr_list , "msg" => '');
                    
                }else{
        
                    $message = array('result' => '0', 'data'=> '', "msg" => 'no data');
                        
                }
                

    }else{
        $message = array('result' => '0', 'data'=> 'Category Id is missing!', "msg" => 'no data');
    
    }

    return response()->JSON($message);
}
                
    
       
    

    

    public function quizapi(Request $request){


        $request->quizId= $request->input('quizId');

        if(!empty($request->quizId)){
        
            $resArr_list= Quiz::find($request->quizId);  
    
                    if(isset($resArr_list->id) && !empty($resArr_list->id)){
            
                        $message = array('result' => '1', 'data'=> $resArr_list , "msg" => '');
                        
                    }else{
            
                        $message = array('result' => '0', 'data'=> '', "msg" => 'no data');
                            
                    }
                    
    
        }else{
            $message = array('result' => '0', 'data'=> 'Quiz Id is missing!', "msg" => 'no data');
        
        }
    
        return response()->JSON($message);

}



    }


    
    	