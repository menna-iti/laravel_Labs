<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\StorePostRequest;


class PostsController extends Controller
{
     public function index()
    {
        $posts = Post::paginate(3);
        $page=$posts->currentPage()-1;

       $post=$posts->first();
       //dd($post->user->name);
        return view('posts.index',[
            'posts' => $posts,
            'page'=>$page
        ]);
        

        //return Post::all();

        //dd(Post::all()[0]->title);
    }


    public function create()
    {
        $users = User::all();

        return view('posts.create',[
            'users' => $users
        ]);
    }


    public function store(StorePostRequest $request)
    {
        // dd($request->all());
        // $this->validate($request,[

        //       'title'=>'required|unique:posts|min:3',
        //       'description'=>'required|min:10',
        //       'user_id' => 'exists:users,id',
        //      ]);
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);
        
       return redirect(route('posts.index')); 
    }


//     public function store(Request $request)
// {
//     // The incoming request is valid...

//     // Retrieve the validated input data...
//     $request->validat([

//     'title'=>'required | min:3',
//     'description'=>required,
// ]);

// }


    public function show($id){
      
        return view('posts.showposts',['post' => Post::findOrFail($id)]);
    }


    // public function edite(){

    //     return view('posts.editeposts',['posts' => Post::findorfail($id)]);
    // }

    public function edite($id){
        $post=Post::find($id);
        $users = User::all();
        return view('posts.editeposts',[
            'post' => $post,
            'users' => $users
        ]);
    }


    public function update(StorePostRequest $request,Post $post)
    {
       
       
        $new_post = $request->only(['title', 'description', 'user_id']);
        $post->update($new_post);
        
       return redirect('/posts'); 
        
    }

    // public function update(Request $request,$id)
    // {
    //     Post::where('id',$id)->update([
    //         'title'=>$request->title,
    //         'description'=>$request->description,
    //         'user_id'=>$request->user_id
       
    //     ]);
    //     return redirect(route('post'));
    // }



    public function destroy(Post $post)
    {
       $post->delete();
        //$post = $posts->first();
        return redirect(route('posts.index'));
    }


    // public function destroy($id)
    // {
    //     // delete
    //     $posts = Post::find($id);
    //     $post->delete();

    //     // redirect
    //     Session::flash('message', 'Successfully deleted the post');
    //     return redirect(route('posts.index'));
    // }




}
