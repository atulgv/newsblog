<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Person;
use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showMyData(){
        $posts = Post::with(['person','category'])->where('person', '=',Person::where('name','=',session()->get('name'))->get()->toArray()[0]['person_id'])->get()->toArray();
        $sidebar = Post::with(['category','person'])->orderBy('created_at','desc')->limit(5)->get()->toArray();
        $categories = Category::get()->toArray();
        $data = compact('posts','sidebar','categories');
        return view('user.userdata')->with($data);
    }

    public function showNewPost(){
        $post = [];
        $title = [
            'title' => 'Create new post',
            'button' => 'Create',
        ];
        $categories = Category::get()->toArray();
        $data = compact('post','title','categories');
        return view('user.newpost')->with($data);
    }

    public function newPost(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'category' => 'required'
        ]);

        if (empty($request->file('image'))){
            $path1 = 'noImg.jpg';
        }else{
            $fileName = time().'rapidnews.'. $request->file('image')->getClientOriginalExtension();
            $path1 = $request->file('image')->storeAs('uploads',$fileName,'public');
        }

        $post = new Post();
        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->image = '/storage/'.$path1;
        $post->slug = '';
        $post->person = Person::where('name','=', session()->get('name'))->get('person_id')->toArray()[0]['person_id'];
        $post->category = $request['category'];
        $post->save();

        return redirect('/user/show-my-data');
    }

    public function showEditPost(Request $request){
        $post = Post::where('post_id','=',$request['id'])->get()->toArray();
        $title = [
            'title' => 'Edit post',
            'button' => 'Update',
        ];
        $categories = Category::get()->toArray();
        $data = compact('post','title','categories');
        return view('user.newpost')->with($data);
    }

    public function editPost(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'category' => 'required'
        ]);

        if (empty($request->file('image'))){
            $path1 = 'noImg.jpg';
        }else{
            $fileName = time().'rapidnews.'. $request->file('image')->getClientOriginalExtension();
            $path1 = $request->file('image')->storeAs('uploads',$fileName,'public');
        }

        Post::where('post_id','=',$id)->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'image' => '/storage/'.$path1,
            'person' => Person::where('name','=', session()->get('name'))->get('person_id')->toArray()[0]['person_id'] ,
            'category' => $request['category'],
        ]);

        return redirect('/user/show-my-data');
    }

    public function deletePost($id){
        Post::where('post_id','=',$id)->delete();

        return redirect('/user/show-my-data');
    }
}
