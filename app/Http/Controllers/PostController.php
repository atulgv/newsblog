<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showHomePage(){
        $posts = Post::with(['category','person'])->get()->toArray();
        $sidebar = Post::with(['category','person'])->orderBy('created_at','desc')->limit(5)->get()->toArray();
        $categories = Category::get()->toArray();
        $data = compact('posts','categories','sidebar');
        return view('home')->with($data);
    }

    public function showCategoryPage(Request $request){
        $category = Category::with('post')->where('category_id','=',$request['category'])->get()->toArray();
        $sidebar = Post::with(['category','person'])->orderBy('created_at','desc')->limit(5)->get()->toArray();
        $categories = Category::get()->toArray();
        $data = compact('category','categories','sidebar');
        return view('category')->with($data);
    }

    public function showSinglePostPage(Request $request){
        $post = Post::with(['category','person'])->where('post_id','=',$request['post'])->get()->toArray();
        // echo '<pre>';
        // print_r($post);
        // echo '</pre>';
        // die;
        $categories = Category::get()->toArray();
        $comment = Comment::with(['post','person'])->where('post','=',$request['post'])->get()->toArray();
        $data = compact('post','categories','comment');
        return view('singlepost')->with($data);
    }

    public function addComment(Request $request){
        $comment = new Comment();
        $comment->content = $request['content'];
        $comment->person = 2;
        $comment->post = $request['post'];
        $comment->save();

        return redirect()->back();
    }

    public function showSearchPage(Request $request){
        if ($request['search-item'] == 'title'){
            $posts = Post::with(['category','person'])->where('title','like','%'.$request['search'].'%')->get()->toArray();
        }else{
            $posts = Post::with(['category','person'])->where('description','like','%'.$request['search'].'%')->get()->toArray();
        }
        $sidebar = Post::with(['category','person'])->orderBy('created_at','desc')->limit(5)->get()->toArray();
        $categories = Category::get()->toArray();
        $search = $request['search'];
        $data = compact('posts','categories','sidebar','search');
        return view('search')->with($data);
    }
}
