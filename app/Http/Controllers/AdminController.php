<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\App;
use App\Models\Category;
use App\Models\Language;
use App\Models\Quiz;
use DB;
use App\Models\User;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Routes;


class AdminController extends Controller
{
    public function __construct(Request $request){
         $pageno = $request->perPage;

          if(empty($pageno)){
                $pageno = 5;
          }
             Session::put('perPage', $pageno);
    }



  /*logout*/
public function logout(Request $request)
   {
        return redirect('login')->with(Auth::logout());
    }


/*profile update */
      public function Passwordupdate(Request $request, $id){

        $rules=[
          'name' => 'required',
          'email' => 'required',
        ];
      
        
      if($request->myCheck==1){
        $rules['password'] = 'required|min:8|max:50';
          $rules['confirmpassword'] = 'required|min:8|max:50';

      } 

        $request->validate($rules);


        $name= $request->input('name');
        $email= $request->input('email');
        $password = $request->input('password');
        $confirmpassword = $request->input('confirmpassword');

      if(empty($password)){
            $update = User::find($id);
            $update->name= $request->input('name');
            $update->email = $request->input('email');
            $update->save();
        return response()->json([ 'status' => '1', 'msg'=>'Profile Update Successfully!!']);

      }else{

          if($password == $confirmpassword){
            $update = User::find($id);
            $update->password=  Hash::make($request->password);
           
            $update->email = $request->input('email');;
            $update->save();
          return response()->json([ 'status' => '1', 'msg'=> 'Profile Update Successfully']);
          }else{
            return response()->json(['status' => '0', 'msg'=> 'Two Password Do Not Match!']);
        }
     }
  }
        


/* add new app */
public function NewAppinsert(Request $request){
  
  $request->validate([
    'app_name'=>'required|alpha|min:3|max:40',
  ]);


  $new_app = new App;
  $new_app->app_name = $request->app_name;
  $new_app->category_id = implode(",", $request->category_id);
  $new_app->save(); 
  return redirect("app-list");
     
}




//app lists
public function applistselect(Request $request){

  $search = $request->input('search');
  $searchby = $request->input('select');
  $searchid = $request->input('id');
  $status = $request->input('status');
     
  if($status == 'enabled'){
    $status_r = '1';
  }elseif($status == 'disabled'){
    $status_r = '2';
  }
  
$data= App::all();

  
  if($searchby == "id" && $status == 'all'){
    $data = App::join('categories', 'apps.category_id','=', 'categories.id')
    ->select('categories.*', 'apps.category_id', 'apps.id', 'apps.app_name', 'apps.status')
    ->where('apps.id','LIKE', '%' . $search . '%')
    ->paginate();

    $newArr = array();

    foreach($data as $row){

      $cat_ids_str = $row->category_id; //1,2,

      $sql = "select category_name from categories where id in (". $cat_ids_str.")";
      $select_qu = DB::select($sql);
      $catname_Tstr=[];

        foreach($select_qu as $row2){
            $catname_Tstr[] = $row2->category_name;
        }

      $catname = implode(',', $catname_Tstr); // ar,leg

      $row->category_id_as_name = $catname;
      $newArr[] = $row;
  }

    return view('app-list',compact('data'));
  
  }
  if($searchby == "id" ){

    $data = App::join('categories', 'apps.category_id','=', 'categories.id')
    ->select('categories.*', 'apps.category_id', 'apps.id', 'apps.app_name', 'apps.status')
    ->where('apps.id','LIKE', '%' . $search . '%')
    ->Where('apps.status',$status_r)
    ->paginate();
      $newArr = array();

    foreach($data as $row){

      $cat_ids_str = $row->category_id; //1,2,

      $sql = "select category_name from categories where id in (". $cat_ids_str.")";
      $select_qu = DB::select($sql);
      $catname_Tstr=[];

        foreach($select_qu as $row2){
            $catname_Tstr[] = $row2->category_name;
        }

      $catname = implode(',', $catname_Tstr); // ar,leg

      $row->category_id_as_name = $catname;
      $newArr[] = $row;
  }
  return view('app-list',compact('data'));

  
    }
  
    if($searchby == "app_name" && $status == 'all'){
      
      $data = App::join('categories', 'apps.category_id','=', 'categories.id')
      ->select('categories.*', 'apps.category_id', 'apps.id', 'apps.app_name', 'apps.status')
    ->where('apps.app_name','LIKE', '%' . $search . '%')
    ->paginate();
      $newArr = array();

    foreach($data as $row){

      $cat_ids_str = $row->category_id; //1,2,

      $sql = "select category_name from categories where id in (". $cat_ids_str.")";
      $select_qu = DB::select($sql);
      $catname_Tstr=[];

        foreach($select_qu as $row2){
            $catname_Tstr[] = $row2->category_name;
        }

      $catname = implode(',', $catname_Tstr); // ar,leg

      $row->category_id_as_name = $catname;
      $newArr[] = $row;
  }
  return view('app-list',compact('data'));
  
    }
    if($searchby == "app_name"){
      $data = App::join('categories', 'apps.category_id','=', 'categories.id')
    ->select('categories.*', 'apps.category_id', 'apps.id', 'apps.app_name', 'apps.status')
    ->where('apps.app_name','LIKE', '%' . $search . '%')
    ->Where('apps.status',$status_r)
    ->paginate();

      $newArr = array();

    foreach($data as $row){

      $cat_ids_str = $row->category_id; //1,2,

      $sql = "select category_name from categories where id in (". $cat_ids_str.")";
      $select_qu = DB::select($sql);
      $catname_Tstr=[];

        foreach($select_qu as $row2){
            $catname_Tstr[] = $row2->category_name;
        }

      $catname = implode(',', $catname_Tstr); // ar,leg

      $row->category_id_as_name = $catname;
      $newArr[] = $row;
  }

  return view('app-list',compact('data'));

    }
    
  
//search list
$search = $request->input('search');
$searchby = $request->input('select');
$status = $request->input('select');

if(isset($search) && isset($searchby) && isset($status)){
  $app_id=$request->input('app_id');
  $app_name=$request->input('app_name');
  $all=$request->input('all');
  $disabled=$request->input('disabled');
  $enabled=$request->input('enabled');

  $data = App::when('search' ,function($query) use ($search) {
    $query->where('app_name', 'LIKE', "%{$search}%");
    $query->where('id', 'LIKE', "%{$search}%");
     $query->orWhere('category_id', 'LIKE', "%{$search}%");
  })->paginate();

if($search === $app_id){
  $data = App::when('search' ,function($query) use ($search) {
    $query->orWhere('category_id', 'LIKE', "%{$search}%");
  })->paginate();
}else if($search === $app_name){
  $data = App::when('search' ,function($query) use ($search) {
    $query->where('app_name', 'LIKE', "%{$search}%");
  })->paginate();
}


$newArr = array();

  foreach($data as $row){

      $cat_ids_str = $row->category_id; //1,2,

      $sql = "select category_name from categories where id in (". $cat_ids_str.")";
      $select_qu = DB::select($sql);
      $catname_Tstr=[];

        foreach($select_qu as $row2){
            $catname_Tstr[] = $row2->category_name;
        }

      $catname = implode(',', $catname_Tstr); // ar,leg

      $row->category_id_as_name = $catname;
      $newArr[] = $row;
  }

       return view('app-list',compact('data'));
}


      $no = Session::get('perPage'); 
      if(!empty($request->input('perPage'))){
           $no=$request->input('perPage');
      }else{
          $no=5;
      }

      $data = App::latest()->paginate($no);



    $newArr = array();

    foreach($data as $row){ 

    $cat_ids_str = $row->category_id; //1,2,

    $sql = "select category_name from categories where id in (". $cat_ids_str.")";
    $select_qu = DB::select($sql);
    $catname_Tstr=[];
    foreach($select_qu as $row2){
      $catname_Tstr[] = $row2->category_name;
    }
    $catname = implode(',', $catname_Tstr); // ar,leg

    $row->category_id_as_name = $catname;
    $newArr[] = $row;
  }

    return view('app-list',compact('data'));

 }
 



 
 //app list enable, disable, delete
 public function ApplistAction(Request $request)
 {

  $ids = $request->ids;
  $action = $request->action;
  $resArr= ['success'=>"Enable"];
  if($action == 'delete'){
    App::whereIn('id',explode(",",$ids))->delete();
    $resArr= ['success'=>"Deleted"];

  }
  else if($action == 'disable'){
  
    App::whereIn('id',explode(",",$ids))->update(['status' => "2"]);


    $resArr= ['success'=>"Disabled"];

  }
  else
  App::whereIn('id',explode(",",$ids))->update(['status' => "1"]);



  return response()->json($resArr);
}



//edit app list
public function AppSelect(Request $request, $id)
{
  
    // $apps = App::findOrFail($id);
    $categories = Category::all();
    // return view('app-list-update',compact('apps', 'categories'));
    


    $apps = App::find($id);
    $newArr = array();
  
    // foreach($apps as  $row){
      foreach($apps as $row){

      $sql = "select category_name from categories where id in ($apps->category_id)";
      $select_qu = DB::select($sql);
      $catname_Tstr=[];
      foreach($select_qu as $row2){
        $catname_Tstr[] = $row2->category_name;
        
      }
     
     
    $newArr = $catname_Tstr;
   
    }

      return view('app-list-update',compact('apps', 'categories', 'newArr'));


}



public function Appupdate(Request $request, $id){
  $request->validate([
    'app_name'=>'required|alpha|min:3|max:40',
  ]);
  
  $name = $request->input('app_name');
  $category_id = $request->input('category_id');
  $category= implode(",", $category_id);
  DB::update('update apps set app_name = ?, category_id = ? where id = ?',[$name, $category, $id]);

    return redirect("app-list");

}





 public function catname_get($cat_ids_str){

  
    return view('app-list',['select'=>$select]);

 }


public function NewAppselectnames(){
  $appnames=Category::all();
  return view('add-new-app',['appnames'=>$appnames]);
}




public function deleteApplist($id){

App::find($id)->delete();
return back()->with("message", "Deleted!!");

}


//appstatus
public function appupdatestatus(Request $request, $id){
 
 if(isset($_POST['enable'])){
  $status= 2;
  $enable = App::find($id);
  $enable->status = $status;  
  $enable->save();
 return back();
 }
 if(isset($_POST['disable'])){
   $status= 1;
   $enable = App::find($id);
   $enable->status = $status;  
   $enable->save();
 return back();
 }

}

public function categoryupdatestatus(Request $request, $id){
 
  if(isset($_POST['enable'])){  
    $status= 2;
    $enable = Category::find($id);
    $enable->status = $status;  
    $enable->save();
  return back();
  }
  if(isset($_POST['disable'])){
    $status= 1;
    $enable = Category::find($id);
    $enable->status = $status;  
    $enable->save();
  return back();
  }
 
 }



//category select
public function categoryselect(){

  $languages = Language::all()->sortByDesc("name");;
  return view('add-new-category', ['selects'=>$languages]);
}

//category insert
public function categoryinsert(Request $request){

  $request->validate([
    'language_id' => 'required',
    'category_name' => 'required|alpha|min:3|max:40',
]);

$new_category = new Category;
$new_category->language_id = $request->language_id;
$new_category->category_name  = $request->category_name ;
  $new_category->save(); 

  return response()->json([ 'success'=> 'Message sending successfully!']);

}



//category select..

public function categorylistselect(Request $request){
  
      //search list
      $search = $request->input('search');
      $searchby = $request->input('select');
      $status= $request->input('status');

      // if(!empty($search)){

      //   $data=Category::when($request->has("search", "select"),function($q)use($request){
      //     return $q->where("category_name","like","%".$request->get("search")."%");
      //     return $q->where("category_img","like","%".$request->get("select")."%");
      //     return $q->where("status","like","%".$request->get("select")."%");
      //   })->paginate();
      // }




      if($status == 'enabled'){
        $status_r = '1';
      }elseif($status == 'disabled'){
        $status_r = '2';
      }
      
      
      if($searchby == "id" && $status == 'all'){
        $data = Category::join('languages', 'categories.language_id','=', 'languages.id')
        ->select('languages.*', 'languages.name', 'categories.id', 'categories.category_name','categories.status')
        ->where('categories.id','LIKE', '%' . $search . '%')
        ->paginate();
        return view('category-list',compact('data'));
      }
      if($searchby == "id" ){
        $data = Category::join('languages', 'categories.language_id','=', 'languages.id')
        ->select('languages.*', 'languages.name', 'categories.id', 'categories.category_name','categories.status')
        ->where('categories.id','LIKE', '%' . $search . '%')
        ->Where('categories.status',$status_r)
        ->paginate();
        return view('category-list',compact('data'));
      
        }
      
        if($searchby == "category_name" && $status == 'all'){
          $data = Category::join('languages', 'categories.language_id','=', 'languages.id')
        ->select('languages.*', 'languages.name', 'categories.id', 'categories.category_name','categories.status')
        ->where('categories.category_name','LIKE', '%' . $search . '%')
        ->paginate();
        return view('category-list',compact('data'));
        }
        if($searchby == "category_name"){
          $data = Category::join('languages', 'categories.language_id','=', 'languages.id')
          ->select('languages.*', 'languages.name', 'categories.id', 'categories.category_name','categories.status')
          ->where('categories.category_name','LIKE', '%' . $search . '%')
          ->Where('categories.status',$status_r)
          ->paginate();
          return view('category-list',compact('data'));
      
        }
        if($searchby == "language_name" && $status == 'all'){
          $data = Category::join('languages', 'categories.language_id','=', 'languages.id')
          ->select('languages.*', 'languages.name', 'categories.id', 'categories.category_name','categories.status')
          ->where('languages.name','LIKE', '%' . $search . '%')
          ->paginate();
          return view('category-list',compact('data'));
      
        }
        if($searchby == "language_name"){

          $data = Category::join('languages', 'categories.language_id','=', 'languages.id')
          ->select('languages.*', 'languages.name', 'categories.id', 'categories.category_name','categories.status')
          ->where('languages.name','LIKE', '%' . $search . '%')
          ->Where('categories.status',$status_r)
          ->paginate();
          return view('category-list',compact('data'));
      
        }

      $data = Category::join('languages', 'categories.language_id', '=', 'languages.id')
        ->select('languages.*', 'languages.name', 'categories.id', 'categories.language_id','categories.status','categories.category_name', 'categories.created_at')
        ->orderBy('categories.id','desc')     
        ->paginate();

    if(!empty($request->input('perPage'))){
      $no=$request->input('perPage');
      }else{
      $no=5;
      }
      
      $data = Category::join('languages', 'categories.language_id', '=', 'languages.id')
      ->select('languages.*', 'languages.name', 'categories.id', 'categories.language_id','categories.category_name','categories.status', 'categories.created_at')
      ->orderBy('categories.id','desc')     
      ->paginate($no);

     
    return view('category-list',compact('data'));

}


public function categoryedit($id){
 $category= Category::findOrFail($id);
 $languages = Language::all();
 $data = Category::join('languages', 'categories.language_id', '=', 'languages.id')
      ->select('languages.*', 'languages.name', 'categories.id', 'categories.language_id','categories.category_name','categories.status','categories.created_at')
      ->orderBy('categories.id','desc')     
      ->paginate();

return view('category-edit',['category'=>$category, 'selects'=>$languages]);

}

public function categoryupdate(Request $request, $id){

    $request->validate([
      'language_id' => 'required',
      'category_name' => 'required|alpha|min:3|max:30',
    ]);

    $language_id = $request->input('language_id');
    $category_name = $request->input('category_name');

    $update = Category::findOrFail($id);
    $update->language_id = $language_id;
    $update->category_name = $category_name;
    $update->save();
    
    return response()->json([ 'success'=> 'Message sending successfully!']);

}


public function categorydelete($id){
 Category::find($id)->delete();
return back()->with("message", "Deleted!!");
}


public function categorylistdeleteAll(Request $request){
  $ids = $request->ids;
     Category::whereIn('id',explode(",",$ids))->delete();
     return response()->json(['success'=>"Deleted successfully."]); 
}


//enable all category..
public function CategoryAction(Request $request){
  $ids = $request->ids;
  $action = $request->action;
  $resArr= ['success'=>"Enable"];
  if($action == 'delete'){
    Category::whereIn('id',explode(",",$ids))->delete();
    $resArr= ['success'=>"Deleted"];

  }
  else if($action == 'disable'){

   
    Category::whereIn('id',explode(",",$ids))->update(['status' => "2"]);

    $resArr= ['success'=>"Disabled"];

  }
  else
  Category::whereIn('id',explode(",",$ids))->update(['status' => "1"]);



  return response()->json($resArr);
}



//quiz category list

public function quizcategorylist(Request $request){
 $category_list = Category::all()->sortByDesc('category_name');
 return view('add-new-quiz', ['category_list'=>$category_list]); 
}

//quiz insert

public function quizinsert(Request $request){

  $rules=[
    'category_id' => 'required',
    'option_count' => 'required',
    'quiz_answer' => 'required',
  ];

  
  
  if($request->question_format_type==0){
    
    $rules['question_name'] = 'required';

  }

  if($request->question_format_type==1){
    $rules['question_name_html'] = 'required';

    
  }



  if($request->option_format_type==0){
    
    $rules['option_1'] = 'required_if:option_count,1,2,3,4,5,6';
    $rules['option_2'] = 'required_if:option_count,2,3,4,5,6';
    $rules['option_3'] = 'required_if:option_count,3,4,5,6';
    $rules['option_4'] = 'required_if:option_count,4,5,6';
    $rules['option_5'] = 'required_if:option_count,5,6';
    $rules['option_6'] = 'required_if:option_count,6';

       
  }
  
  if($request->option_format_type==1){
    $rules['option_1_html'] = 'required_if:option_count,1,2,3,4,5,6';
    $rules['option_2_html'] = 'required_if:option_count,2,3,4,5,6';
    $rules['option_3_html'] = 'required_if:option_count,3,4,5,6';
    $rules['option_4_html'] = 'required_if:option_count,4,5,6';
    $rules['option_5_html'] = 'required_if:option_count,5,6';
    $rules['option_6_html'] = 'required_if:option_count,6';

  }

  $request->validate($rules);
  $quiz = new Quiz;

  $quiz->category_id = $request->category_id;
  $quiz->question_format_type = $request->question_format_type;
  
  $quiz->option_format_type = $request->option_format_type;
  
  if( empty($quiz->question_name = $request->question_name)){
    $quiz->question_name= $request->question_name_html;
  }
  

if( empty($quiz->option_1 = $request->option_1)){
  $quiz->option_1= $request->option_1_html;
}

if( empty($quiz->option_2 = $request->option_2)){
  $quiz->option_2= $request->option_2_html;
}
if( empty($quiz->option_3 = $request->option_3)){
  $quiz->option_3= $request->option_3_html;
}
if( empty($quiz->option_4 = $request->option_4)){
  $quiz->option_4= $request->option_4_html;
}
if( empty($quiz->option_5 = $request->option_1)){
  $quiz->option_5= $request->option_5_html;
}
if( empty($quiz->option_6 = $request->option_6)){
  $quiz->option_6= $request->option_6_html;
}

  $quiz->quiz_answer = $request->quiz_answer;
  $quiz->quiz_hint = $request->quiz_hint;
  $quiz->quiz_exp = $request->quiz_exp;
  $quiz->option_count = $request->option_count;
$quiz->save();
return response()->json([ 'success'=> 'Message sending successfully!']);
}


//quiz select

public function quizlistselect(Request $request){
// $no = Session::get('perPage');
//search list
$search = $request->input('search');
$searchby = $request->input('select');
$searchid = $request->input('id');
$status = $request->input('status');
   
if($status == 'enabled'){
  $status_r = '1';
}elseif($status == 'disabled'){
  $status_r = '2';
}


if($searchby == "id" && $status == 'all'){
  $data = Quiz::join('categories', 'quizs.category_id','=', 'categories.id')
  ->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status')
  ->where('quizs.id','LIKE', '%' . $search . '%')
  ->paginate();
  return view('quiz-list',compact('data'));

}
if($searchby == "id" ){

  $data = Quiz::join('categories', 'quizs.category_id','=', 'categories.id')
    ->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status')
    ->where('quizs.id','LIKE', '%' . $search . '%')
    ->Where('quizs.status',$status_r)
    ->paginate();
    return view('quiz-list',compact('data'));

  }

  if($searchby == "category" && $status == 'all'){
    $data = Quiz::join('categories', 'quizs.category_id','=', 'categories.id')
    ->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status')
    ->where('categories.category_name', 'LIKE', '%' . $search . '%')
    ->paginate();
    return view('quiz-list',compact('data'));

  }
  if($searchby == "category"){
    $data = Quiz::join('categories', 'quizs.category_id','=', 'categories.id')
    ->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status')
    ->where('categories.category_name', 'LIKE', '%' . $search . '%')
    ->Where('quizs.status',$status_r)
    ->paginate(); 
    return view('quiz-list',compact('data'));

  }
  if($searchby == "question" && $status == 'all'){
    $data = Quiz::join('categories', 'quizs.category_id','=', 'categories.id')
    ->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status')
    ->where('quizs.question_name', 'LIKE', '%' . $search . '%')
    ->paginate();
    return view('quiz-list',compact('data'));

  }
  if($searchby == "question"){
    $data = Quiz::join('categories', 'quizs.category_id','=', 'categories.id')
    ->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status')
    ->where('quizs.question_name', 'LIKE', '%' . $search . '%')
    ->Where('quizs.status',$status_r)
    ->paginate();
    return view('quiz-list',compact('data'));

  }

  if(!empty($request->input('perPage'))){
    $no=$request->input('perPage');
   }else{
    
  if(!empty($no)){
    $no=5;
  }else{
   
   $no=Session::get('perPage');
  }
   }

   
$data = Quiz::latest()->join('categories', 'quizs.category_id', '=', 'categories.id')
->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status')
->paginate($no);


return view('quiz-list',compact('data'));
  
$data = Quiz::join('categories', 'quizs.category_id', '=', 'categories.id')
->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status')
->orderBy('quizs.id','desc')     
->paginate();

return view('quiz-list',compact('data'));

  }


//quiz action

public function QuizAction(Request $request){
  $ids = $request->ids;
  $action = $request->action;
  $resArr= ['success'=>"Enable"];
  if($action == 'delete'){
    Quiz::whereIn('id',explode(",",$ids))->delete();
    $resArr= ['success'=>"Deleted"];

  }
  else if($action == 'disable'){

   
    Quiz::whereIn('id',explode(",",$ids))->update(['status' => "2"]);

    $resArr= ['success'=>"Disabled"];

  }
  else
  Quiz::whereIn('id',explode(",",$ids))->update(['status' => "1"]);



  return response()->json($resArr);

}

public function quizedit($id){

$quiz= Quiz::findOrFail($id);

 $categories = Category::all();

return view('quiz-edit',['quiz'=>$quiz, 'categories'=>$categories]);
}

public function quizdelete($id){
  Quiz::find($id)->delete();
return back()->with("message", "Deleted!!");

}

public function quizupdate(Request $request, $id){
  $rules=[
    'category_id' => 'required',
    'option_count' => 'required',
    'quiz_answer' => 'required',
  ];

  
  
  if($request->question_format_type==0){
    
    $rules['question_name'] = 'required';

  }

  if($request->question_format_type==1){
    $rules['question_name_html'] = 'required';

    
  }



  if($request->option_format_type==0){
    
    $rules['option_1'] = 'required_if:option_count,1,2,3,4,5,6';
    $rules['option_2'] = 'required_if:option_count,2,3,4,5,6';
    $rules['option_3'] = 'required_if:option_count,3,4,5,6';
    $rules['option_4'] = 'required_if:option_count,4,5,6';
    $rules['option_5'] = 'required_if:option_count,5,6';
    $rules['option_6'] = 'required_if:option_count,6';

       
  }
  
  if($request->option_format_type==1){
    $rules['option_1_html'] = 'required_if:option_count,1,2,3,4,5,6';
    $rules['option_2_html'] = 'required_if:option_count,2,3,4,5,6';
    $rules['option_3_html'] = 'required_if:option_count,3,4,5,6';
    $rules['option_4_html'] = 'required_if:option_count,4,5,6';
    $rules['option_5_html'] = 'required_if:option_count,5,6';
    $rules['option_6_html'] = 'required_if:option_count,6';

  }
  $request->validate($rules);



  $category_id = $request->input('category_id');
  $question_format_type= $request->input('question_format_type');
  $option_format_type= $request->input('option_format_type');
  $quiz_answer= $request->input('quiz_answer');
  $quiz_hint= $request->input('quiz_hint');
  $quiz_exp= $request->input('quiz_exp');
  $option_count= $request->input('option_count');


    $update = Quiz::findOr($id);
    $update->category_id = $category_id;
    $update->question_format_type = $question_format_type;

  
   
    if($question_format_type==0){
      $update->question_name = $request->input('question_name');


    }
    
  
  if($update->question_format_type==1){
    $update->question_name = $request->input('question_name_html');
    
  }
  
  $update->option_format_type = $option_format_type;

    
  if($request->option_format_type==0){

    $option_1 = $request->input('option_1');

    $option_2 = $request->input('option_2');
    $option_3 = $request->input('option_3');
    $option_4 = $request->input('option_4');
    $option_5 = $request->input('option_5');
    $option_6 = $request->input('option_6');

  }

  if($request->option_format_type==1){
    $option_1 = $request->input('option_1_html');
    $option_2 = $request->input('option_2_html');
    $option_3 = $request->input('option_3_html');
    $option_4 = $request->input('option_4_html');
    $option_5 = $request->input('option_5_html');
    $option_6 = $request->input('option_6_html');
  
 }
    
    $update->quiz_answer = $quiz_answer;
    $update->quiz_hint = $quiz_hint;
    $update->quiz_exp = $quiz_exp;
    $update->option_count = $option_count;
    $update->save();

    return response()->json([ 'success'=> 'Message sending successfully!']);

    return back();
}



//quizstatus
public function quizupdatestatus(Request $request, $id){

if(isset($_POST['enable'])){
  $status= 2;
  $enable = Quiz::find($id);
  $enable->status = $status;  
  $enable->save();

return back();
}
if(isset($_POST['disable'])){
  $status= 1;
  $enable = Quiz::find($id);
  $enable->status = $status;  
  $enable->save();
  return back();
}


}

public function descendingorder(Request $request){


if(!empty($_GET['perPage'])){
  $page=$_GET['perPage'];
}else{
  $page = 5;
}


//quiz_id
if(url('quiz-list/quiz/id/asc') == url()->current()){

  $data = Quiz::oldest('id')
  ->paginate($page);

  $data = Quiz::join('categories', 'quizs.category_id', '=', 'categories.id')
  ->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status')
  ->orderBy('quizs.category_id','asc')     
  ->paginate($page);

  return view('quiz-list', compact('data'));

  }else if(url('quiz-list/quiz/id/desc') == url()->current()){
        
  $data = Quiz::join('categories', 'quizs.category_id', '=', 'categories.id')
  ->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status')
  ->orderBy('quizs.category_id','desc')     
  ->paginate($page);

  return view('quiz-list', compact('data'));
  
}

//quiz_category
if(url('quiz-list/quiz/question/asc') == url()->current()){

      
  $data = Quiz::join('categories', 'quizs.category_id', '=', 'categories.id')
  ->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status')
  ->orderBy('quizs.question_name','asc')     
  ->paginate($page);

  return view('quiz-list', compact('data'));

  }else if(url('quiz-list/quiz/question/desc') == url()->current()){

  $data = Quiz::join('categories', 'quizs.category_id', '=', 'categories.id')
  ->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status')
  ->orderBy('quizs.question_name','desc')     
  ->paginate($page);

  return view('quiz-list', compact('data'));
  
}

//quiz_category_name

if(url('quiz-list/quiz/category_name/asc') == url()->current()){

  $data = Quiz::join('categories', 'quizs.category_id', '=', 'categories.id')
  ->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status')
  ->orderBy('categories.category_name','asc')     
  ->paginate($page);
  return view('quiz-list', compact('data'));

  }else if(url('quiz-list/quiz/category_name/desc') == url()->current()){

    
  $data = Quiz::join('categories', 'quizs.category_id', '=', 'categories.id')
  ->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status')
  ->orderBy('categories.category_name','desc')     
  ->paginate($page);

  return view('quiz-list', compact('data'));
  
}


//quiz_created_at

if(url('quiz-list/quiz/created_at/asc') == url()->current()){

  $data = Quiz::join('categories', 'quizs.category_id', '=', 'categories.id')
  ->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status','quizs.created_at')
  ->orderBy('quizs.created_at','asc')     
  ->paginate($page);

  return view('quiz-list', compact('data'));

  }else if(url('quiz-list/quiz/created_at/desc') == url()->current()){
     
  $data = Quiz::join('categories', 'quizs.category_id', '=', 'categories.id')
  ->select('categories.*', 'categories.category_name', 'quizs.id', 'quizs.category_id', 'quizs.question_name','quizs.status','quizs.created_at')
  ->orderBy('quizs.created_at','desc')     
  ->paginate($page);
  return view('quiz-list', compact('data'));
  
}





/******* category_list *******/

//category_id
if(url('category-list/category/category_id/asc') == url()->current()){

  $data = Category::join('languages', 'categories.language_id', '=', 'languages.id')
  ->select('languages.*', 'languages.name', 'categories.id', 'categories.language_id','categories.category_name','categories.status','categories.created_at')
  ->orderBy('categories.id','asc')     
  ->paginate($page);
  return view('category-list', compact('data'));

  }else if(url('category-list/category/category_id/desc') == url()->current()){

    $data = Category::join('languages', 'categories.language_id', '=', 'languages.id')
    ->select('languages.*', 'languages.name', 'categories.id', 'categories.language_id','categories.category_name','categories.status','categories.created_at')
    ->orderBy('categories.id','desc')     
    ->paginate($page);
  

  return view('category-list', compact('data'));
  
}

//category_category_name
if(url('category-list/category/category_name/asc') == url()->current()){

  $data = Category::join('languages', 'categories.language_id', '=', 'languages.id')
  ->select('languages.*', 'languages.name', 'categories.id', 'categories.language_id','categories.category_name','categories.status', 'categories.created_at')
  ->orderBy('categories.category_name','asc')     
  ->paginate($page);
  return view('category-list', compact('data'));

  }else if(url('category-list/category/category_name/desc') == url()->current()){

    $data = Category::join('languages', 'categories.language_id', '=', 'languages.id')
    ->select('languages.*', 'languages.name', 'categories.id', 'categories.language_id','categories.category_name','categories.status', 'categories.created_at')
    ->orderBy('categories.category_name','desc')     
    ->paginate($page);
    return view('category-list', compact('data'));
  
}


//category_created_at

if(url('category-list/category/created_at/asc') == url()->current()){

  $data = Category::join('languages', 'categories.language_id', '=', 'languages.id')
  ->select('languages.*', 'languages.name', 'categories.id', 'categories.language_id','categories.category_name','categories.status', 'categories.created_at')
  ->orderBy('categories.created_at','asc')     
  ->paginate($page);
  return view('category-list', compact('data'));

  }else if(url('category-list/category/created_at/desc') == url()->current()){

    $data = Category::join('languages', 'categories.language_id', '=', 'languages.id')
    ->select('languages.*', 'languages.name', 'categories.id', 'categories.language_id','categories.category_name','categories.status','categories.created_at')
    ->orderBy('categories.created_at','desc')     
    ->paginate($page);
    return view('category-list', compact('data'));  
  
}


//category_language_name

if(url('category-list/category/language_name/asc') == url()->current()){

  $data = Category::join('languages', 'categories.language_id', '=', 'languages.id')
  ->select('languages.*', 'languages.name', 'categories.id', 'categories.language_id','categories.category_name','categories.status','categories.created_at')
  ->orderBy('languages.name','asc')     
  ->paginate($page);
  return view('category-list', compact('data'));

  }else if(url('category-list/category/language_name/desc') == url()->current()){

  $data = Category::join('languages', 'categories.language_id', '=', 'languages.id')
  ->select('languages.*', 'languages.name', 'categories.id', 'categories.language_id','categories.category_name','categories.status','categories.created_at')
  ->orderBy('languages.name','desc')     
  ->paginate($page);
  return view('category-list', compact('data'));
  
}






/****  app list  *****/

//app_id
if(url('app-list/app/id/asc') == url()->current()){

  $data = App::oldest('id')
  ->paginate($page);

  
  $newArr = array();

  foreach($data as $row){

    $cat_ids_str = $row->category_id; //1,2,

    $sql = "select category_name from categories where id in ($cat_ids_str)";
    $select_qu = DB::select($sql);
    $catname_Tstr=[];
    foreach($select_qu as $row2){
      $catname_Tstr[] = $row2->category_name;
    }
    $catname = implode(',', $catname_Tstr); // ar,leg

    $row->category_id_as_name = $catname;
    $newArr[] = $row;
  }

  return view('app-list', compact('data'));

  }else if(url('app-list/app/id/desc') == url()->current()){

  $data = App::latest('id')
  ->paginate($page);
  
  $newArr = array();

  foreach($data as $row){

    $cat_ids_str = $row->category_id; //1,2,

    $sql = "select category_name from categories where id in ($cat_ids_str)";
    $select_qu = DB::select($sql);
    $catname_Tstr=[];
    foreach($select_qu as $row2){
      $catname_Tstr[] = $row2->category_name;
    }
    $catname = implode(',', $catname_Tstr); // ar,leg

    $row->category_id_as_name = $catname;
    $newArr[] = $row;
  }

  return view('app-list', compact('data'));
  
}

//app_name
if(url('app-list/app/app_name/asc') == url()->current()){

  $data = App::oldest('app_name')
  ->paginate($page);
  
  $newArr = array();

  foreach($data as $row){

    $cat_ids_str = $row->category_id; //1,2,

    $sql = "select category_name from categories where id in ($cat_ids_str)";
    $select_qu = DB::select($sql);
    $catname_Tstr=[];
    foreach($select_qu as $row2){
      $catname_Tstr[] = $row2->category_name;
    }
    $catname = implode(',', $catname_Tstr); // ar,leg

    $row->category_id_as_name = $catname;
    $newArr[] = $row;
  }

  return view('app-list', compact('data'));

  }else if(url('app-list/app/app_name/desc') == url()->current()){

  $data = App::latest('app_name')
  ->paginate($page);

  
  $newArr = array();

  foreach($data as $row){

    $cat_ids_str = $row->category_id; //1,2,

    $sql = "select category_name from categories where id in ($cat_ids_str)";
    $select_qu = DB::select($sql);
    $catname_Tstr=[];
    foreach($select_qu as $row2){
      $catname_Tstr[] = $row2->category_name;
    }
    $catname = implode(',', $catname_Tstr); // ar,leg

    $row->category_id_as_name = $catname;
    $newArr[] = $row;
  }

  return view('app-list', compact('data'));
  
}


//app_category

if(url('app-list/app/created_at/asc') == url()->current()){

  $data = App::oldest('created_at')->paginate($page);

  
  $newArr = array();

  foreach($data as $row){

    $cat_ids_str = $row->category_id; //1,2,

    $sql = "select category_name from categories where id in ($cat_ids_str)";
    $select_qu = DB::select($sql);
    $catname_Tstr=[];
    foreach($select_qu as $row2){
      $catname_Tstr[] = $row2->category_name;
    }
    $catname = implode(',', $catname_Tstr); // ar,leg

    $row->category_id_as_name = $catname;
    $newArr[] = $row;
  }



  return view('app-list', compact('data'));

  }else if(url('app-list/app/created_at/desc') == url()->current()){

    $data = App::latest('created_at')->paginate($page);
  
    $newArr = array();

  foreach($data as $row){

    $cat_ids_str = $row->category_id; //1,2,

    $sql = "select category_name from categories where id in ($cat_ids_str)";
    $select_qu = DB::select($sql);
    $catname_Tstr=[];
    foreach($select_qu as $row2){
      $catname_Tstr[] = $row2->category_name;
    }
    $catname = implode(',', $catname_Tstr); // ar,leg

    $row->category_id_as_name = $catname;
    $newArr[] = $row;
  }

  return view('app-list', compact('data'));
  
}


//created_at
if(url('app-list/app/category_id/asc') == url()->current()){


  $data = App::oldest('category_id')->paginate($page);
  
  $newArr = array();

  foreach($data as $row){

    $cat_ids_str = $row->category_id; //1,2,

    $sql = "select category_name from categories where id in ($cat_ids_str)";
    $select_qu = DB::select($sql);
    $catname_Tstr=[];
    foreach($select_qu as $row2){
      $catname_Tstr[] = $row2->category_name;
    }
    $catname = implode(',', $catname_Tstr); // ar,leg

    $row->category_id_as_name = $catname;
    $newArr[] = $row;
  }



  return view('app-list', compact('data'));

  }else if(url('app-list/app/category_id/desc') == url()->current()){

    $data = App::latest('category_id')->paginate($page);


    $newArr = array();

  foreach($data as $row){

    $cat_ids_str = $row->category_id; //1,2,

    $sql = "select category_name from categories where id in ($cat_ids_str)";
    $select_qu = DB::select($sql);
    $catname_Tstr=[];
    foreach($select_qu as $row2){
      $catname_Tstr[] = $row2->category_name;
    }
    $catname = implode(',', $catname_Tstr); // ar,leg

    $row->category_id_as_name = $catname;
    $newArr[] = $row;
  }


  return view('app-list', compact('data'));
  
}


}


}