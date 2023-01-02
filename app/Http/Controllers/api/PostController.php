<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct(){
        $this->middleware('auth:sanctum',)->except('index');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Post::paginate('5');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'content'=>'required|string',
            'image'=>'|image'

        ]);
        $data=$request->all();
       $image=$request->file('image');
       if ($request->hasFile('image')){
           $imageurl=$image->store('image','public');
           $data['image']=$imageurl;
       }
        $data['user_id']=Auth::id();
        $post=Post::create($data);
        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'content'=>'required|string',
            'image'=>'string|image'

        ]);
        $post->update($request->all());
        return $post;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        return $post->delete();;
    }
}
