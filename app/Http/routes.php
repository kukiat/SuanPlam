<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Route::get('1',function (){
//  return 'Hello laravel';
//});
//Route::get('welcome/hello','Controller@hello');
//Route::get('welcome/page/{id}/{title}','Controller@page')
  //->where(['id'=>'[0-9]+','title'=>'[a-zA-z]+']);
//Route::Controller('welcome','Controller');

Route::get('/', [
  'uses' => '\App\Http\Controllers\HomeController@index',
  'as' => 'home',
]);
Route::get('/alert',function(){
  return redirect()->route('home')->with('info');
});
Route::get('/signup', [
  'uses' => '\App\Http\Controllers\MembersController@getSignup',
  'as' => 'member.signup',
  'middleware' => ['guest'],
]);
Route::post('/signup', [
  'uses' => '\App\Http\Controllers\MembersController@postSignup',
  'middleware' => ['guest'],
]);
Route::get('/signin', [
  'uses' => '\App\Http\Controllers\MembersController@getSignin',
  'as' => 'member.signin',
  'middleware' => ['guest'],
]);
Route::post('/signin', [
  'uses' => '\App\Http\Controllers\MembersController@postSignin',
  'middleware' => ['guest'],
]);
Route::get('/signout', [
  'uses' => '\App\Http\Controllers\MembersController@getSignout',
  'as' => 'member.signout',
]);
Route::get('/feed', [
  'uses' => '\App\Http\Controllers\HomeController@feedindex',
  'as' => 'feed.index',
]);
Route::get('/feed/create', [
  'uses' => '\App\Http\Controllers\feedController@createtopic',
  'as' => 'create.topic',
  'middleware' => ['auth'],
]);
Route::post('/status',[
  'uses' => '\App\Http\Controllers\FeedController@postStatus',
  'as' => 'status.post',
  'middleware' => ['auth'],
]);
Route::get('/feed/{blog}',[
  'uses' => '\App\Http\Controllers\FeedController@Blog',
  'as' => 'blog.blog',

])->where(['blog'=>'[0-9]+']);
Route::get('/profile/{num}',[
  'uses' => '\App\Http\Controllers\ProfileController@getProfile',
  'as' => 'profile.profile',
])->where(['num'=>'[0-9]+']);

Route::post('/profile',[
  'uses' => '\App\Http\Controllers\ProfileController@postProfile',
  'as' => 'profile.edit',

]);
Route::post('/profilee',[
  'uses' => '\App\Http\Controllers\ProfileController@postavatar',
  'as' => 'profile.avatar',

]);


Route::post('/comment/{blog}',[
  'uses' => '\App\Http\Controllers\FeedController@postComment',
  'as' => 'comment.comment',
  'middleware' => ['auth'],
]);



Route::get('/classroom',[
  'uses' => '\App\Http\Controllers\ClassroomController@getShow',
  'as' => 'classroom.classroom',
]);
Route::get('/club/{id}/create',[
  'uses' => '\App\Http\Controllers\ClubController@createclub',
  'as' => 'create.club',
  'middleware' => ['auth'],
]);




Route::get('/classroom/ajax/{sub}',[
	'uses' => '\App\Http\Controllers\ClassroomController@xxx',
  'as' => 'ajax'
]);
Route::get('/classroom/aja/{su}',[
	'uses' => '\App\Http\Controllers\ClassroomController@xxxx',
  'as' => 'aja'
]);
Route::get('/classroom/aj/{cha}',[
	'uses' => '\App\Http\Controllers\ClassroomController@xxxxx',
  'as' => 'aj',
]);
Route::get('/classroom/fill/{dd}/{cc?}',[
	'uses' => '\App\Http\Controllers\ClassroomController@fill',
  'as' => 'fill',
]);


Route::post('/commenttclassroom',[
  'uses' => '\App\Http\Controllers\ClassroomController@CommentClassroom',
  'as' => 'comment.class',
]);
Route::get('/tag/{tag_id}',[
  'uses' => '\App\Http\Controllers\FeedController@getTag',
  'as' => 'getTag',
]);


Route::post('/addcageory',[
  'uses' => '\App\Http\Controllers\FeedController@addcageory',
  'as' => 'addcageory',
]);
Route::post('/replyinreply',[
  'uses' => '\App\Http\Controllers\FeedController@replyinreplyy',
  'as' => 'replyinreply',
]);


Route::get('/test',[
  'uses' => '\App\Http\Controllers\HomeController@testt',
  'as' => 'dwdjajaja',
]);
Route::get('/club',[
  'uses' => '\App\Http\Controllers\ClubController@getmain',
  'as' => 'mainclub',
]);
Route::post('/posttest',[
  'uses' => '\App\Http\Controllers\HomeController@posttestt',
  'as' => 'dposttest',
]);


Route::get('/postja',[
  'uses' => '\App\Http\Controllers\HomeController@postja',
  'as' => 'jajaja',
]);
Route::post('/postjaaaa',[
  'uses' => '\App\Http\Controllers\HomeController@postjaa',
  'as' => 'jajajaa',
]);

Route::post('/postaddname',[
  'uses' => '\App\Http\Controllers\ClubController@postaddname',
  'as' => 'postaddname',
]);
Route::post('/postrequest',[
  'uses' => '\App\Http\Controllers\ClubController@postrequestuser',
  'as' => 'postrequest.postrequest',
]);

Route::get('/club/{club}',[
  'uses' => '\App\Http\Controllers\ClubController@pageeee',
  'as' => 'getpage.getpage',
]);
Route::post('/postrequestsubmit',[
  'uses' => '\App\Http\Controllers\ClubController@postrequestsubmit',
  'as' => 'postrequestsubmit',
]);
Route::post('/postrequestreject',[
  'uses' => '\App\Http\Controllers\ClubController@postrequestreject',
  'as' => 'postrequestreject',
]);
Route::post('/postrequestclubforother',[
  'uses' => '\App\Http\Controllers\ClubController@postrequestclubforother',
  'as' => 'postrequestclubforother',
]);
Route::post('/postsubmitrequestclub',[
  'uses' => '\App\Http\Controllers\ClubController@postsubmitrequestclub',
  'as' => 'postsubmitrequestclub',
]);
Route::post('/postrejectrequestclub',[
  'uses' => '\App\Http\Controllers\ClubController@postrejectrequestclub',
  'as' => 'postrejectrequestclub',
]);
Route::post('/postsubmitfriend',[
  'uses' => '\App\Http\Controllers\ClubController@postsubmitfriend',
  'as' => 'postsubmitfriend',
]);
Route::post('/postrejectfriend',[
  'uses' => '\App\Http\Controllers\ClubController@postrejectfriend',
  'as' => 'postrejectfriend',
]);

Route::post('/postclubdetail',[
  'uses' => '\App\Http\Controllers\ClubController@postclubdetail',
  'as' => 'postclubdetail',
]);
Route::post('/postcommentclub',[
  'uses' => '\App\Http\Controllers\ClubController@postcommentclub',
  'as' => 'postcommentclub',
]);
Route::post('/tests',[
  'uses' => '\App\Http\Controllers\ClubController@tests',
  'as' => 'tests',
]);
Route::post('/editclubpic',[
  'uses' => '\App\Http\Controllers\EditController@editclubpic',
  'as' => 'editclubpic',
]);
Route::post('/commentt',[
  'uses' => '\App\Http\Controllers\EditController@editcomment',
  'as' => 'comment.edit',
]);
Route::post('/scrollw',[
  'uses' => '\App\Http\Controllers\HomeController@scrollw',
  'as' => 'scrollw',
]);
Route::post('/newwwwget',[
  'uses' => '\App\Http\Controllers\HomeController@newwwwget',
  'as' => 'newwwwget',
]);
