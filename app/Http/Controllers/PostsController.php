<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::with('category')->where(function ($post) use($request){
            if($request->input('category_id'))
            {
                $post->where('category_id',$request->category_id);
            }
            if($request->input('keyword')&& $request->action =="") {

                $post->where(function ($post)use($request){
                    $post->where('title','like','%'.$request->keyword.'%');
                    $post->orWhere('body','like','%'.$request->keyword.'%');
                });

            }elseif ($request->input('keyword') && $request->action =="all"){
                $post->where('title','like','%'.$request->keyword.'%');
                $post->orWhere('body','like','%'.$request->keyword.'%');
            }
        })->latest()->paginate(10);

        return view('Admin.Posts.read')->with(['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|max:200',
            'image'=>'image',
            'body'=>'required|max:1000',
            'category_id'=>'required|numeric'
        ]);
        if ($request->hasFile('image')){
            $imageExt = $request->file('image')->getClientOriginalExtension();
            $imageName = time().'thumbnail.'.$imageExt;
            $request->file('image')->storeAs('thumbnails/',$imageName);
        }
        Post::create([
            'title' => $request->input('title'),
            'image' => $imageName,
            'body' => $request->input('body'),
            'category_id'=>$request->input('category_id'),
        ]);
        return redirect(route('posts.index'))->with('msg', 'saved new post!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::findOrFail($id);
        return view('Admin.Posts.show')->with(['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::findOrFail($id);
        return view('Admin.Posts.update')->with(['post'=>$post]);
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
        $this->validate($request,[
            'title'=>'required|max:200',
            'image'=>'required|image',
            'body'=>'required|max:1000',
            'category_id'=>'required|numeric'
        ]);

        if ($request->hasFile('image')){
            $imageExt = $request->file('image')->getClientOriginalExtension();
            $imageName = time().'thumbnail.'.$imageExt;
            $request->file('image')->storeAs('thumbnails/',$imageName);
        }
        $post=Post::findorfail($id);
        $post->update([
            'title' => $request->input('title'),
            'image' => $imageName,
            'body' => $request->input('body'),
            'category_id'=>$request->input('category_id'),
        ]);
        $post->save();

        return redirect(route('posts.index'))->with('msg', 'post is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::findorfail($id);
        Storage::disk('public')->delete('thumbnails/' . $post->image);
        $post->destroy($id);
        return redirect()->route('posts.index')->with('msg', 'Delete post success');
    }
}
