<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ratereview;
use App\Models\User;
use DB;

class RatingReviewController extends Controller
{
    public function create_Rating(Request $request){
        $response=[];
  
        if($request['rating'] == ''){
            $response['rating'] = "Please Enter Rating";
        }
        if(count($response)){
            $response['status'] = 'eroor';
            return response()->json($response, 403);
        }else{
         try{
              if($request->user['role'] == 'user'){
                      $Rating = Ratereview::create([
                          'user_id' => $request->user['id'],
                          'course_id' => $request->course_id,
                          'name'=> $request->user['full_name'],
                          'description'=> $request->description,
                          'rating'=> $request->rating,
                          'title'=> $request->title
                      ]);
                      if($Rating){
                          return response()->json([
                              'status' => true,
                              'message' => 'Rating Create successfully!'
                          ], 200);
                      }
              }
              else{
                  $response['status'] = 'error';
                  $response['message'] = 'Only  User can use Rating';
                  return response()->json($response, 403);
             }
         }
         catch(Exception $e){
           return $e;
         }
      }
     }

     public function get_course_Rating_Review(Request $request){
        try{
         if($request->user['role'] == 'user'){
            $get_Rating = User::leftJoin('ratereview', 'ratereview.user_id', '=', 'users.id')
            ->select('ratereview.*','users.full_name')
            ->where('ratereview.course_id', '=',$request->course_id)
            ->get();
             if($get_Rating){
                 return response()->json([
                     'success'=>true,
                     'response'=>$get_Rating
                 ],200);
             }
             else{
                 $response['status'] = 'error';
                 $response['message'] = 'Only  User can fetch Data Rating';
                 return response()->json($response, 403);
         }
         }
        }
        catch(Exception $e){
         return $e;
        }
    }

    public function  course_rating_avg(Request $request)
    {
      try{
         if($request->user['role'] == 'user'){
            $Rating = DB::table('ratereview')->where('course_id','=', $request->course_id)
            ->get()->avg('rating');
                if($Rating){
                return response()->json([
                    'success'=>true,
                    'response'=>$Rating
                ],200);
                }
                else{
                    $response['status'] = 'error';
                    $response['message'] = 'Only User can fetch Rating';
                    return response()->json($response, 403);
                }
            }
        }catch(Exception $e){
            return $e;
        }
    }

    public function totalRating(Request $request){
        try{
         if($request->user['role'] == 'user'){
             $response=[];
     //rating
             $product_review = DB::table('ratereview')
             ->where('course_id', '=',$request->course_id)
             ->where('title','!=', '')
             ->where('description', '!=', '')
             ->get();
             $product_rating = DB::table('ratereview')
             ->where('course_id','=',$request->course_id)
             ->where('rating','!=','')
             ->get();
             $review = $product_review->count();
             $rating = $product_rating->count();
             $response['product_rating'] = $rating;
             $response['product_review'] = $review;
             return response()->json([
                 'success'=>true,
                 'response'=> $response
             ],200);
         }
        }
        catch(Exception $e){
            return $e;
        }
    }

    public function ratingProgressBar(Request $request){
        try{
            $allprogress = [];
            if($request->user['role'] == 'user'){
                $product_rating = Ratereview::where('course_id','=',$request->course_id)
                ->select('rating')
                ->get()
                ->toArray();
                $progress = [];
                $progress['count5'] = 0;
                $progress['count4'] = 0;
                $progress['count3'] = 0;
                $progress['count2'] = 0;
                $progress['count1'] = 0;
                 foreach($product_rating as $progressRate){
                    if($progressRate['rating'] == 5){
                        $progress['count5']++;
                    }
                    if($progressRate['rating'] == 4){
                        $progress['count4']++;
                    }
                    if($progressRate['rating'] == 3){
                        $progress['count3']++;
                    }
                    if($progressRate['rating'] == 2){
                        $progress['count2']++;
                    }
                    if($progressRate['rating'] == 1){
                        $progress['count1']++;
                    }
                 }
                return response()->json([
                    'success'=>true,
                    'response'=> $progress
                ],200);
            }
        }catch(Exception $e){
                return $e;
            }
    }
}