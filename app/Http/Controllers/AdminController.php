<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Person;
use App\Models\Post;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AdminController extends Controller
{
    public function showPersonsData(){
        $persons = Person::get()->toArray();
        $data = compact('persons');
        return view('admin.usersdata')->with($data);
    }

    public function showPostsData(){
        $posts = Post::with(['person','category'])->get()->toArray();
        $data = compact('posts');
        return view('admin.postsdata')->with($data);
    }

    public function showCategoryData(){
        $categories = Category::get()->toArray();
        $data = compact('categories');
        return view('admin.categorydata')->with($data);
    }

    public function showCommentsData(){
        $comments = Comment::with(['person','post'])->get()->toArray();
        $data = compact('comments');
        return view('admin.commentsdata')->with($data);
    }

    public function showEditPerson(Request $request){
        $person = Person::where('person_id','=',$request['id'])->get()->toArray();
        $title = [
            'title' => 'Edit user',
            'button' => 'Update',
        ];
        $data = compact('person','title');
        return view('admin.newperson')->with($data);
    }

    public function showEditCategory(Request $request){
        $category = Category::where('category_id','=',$request['id'])->get()->toArray();
        $title = [
            'title' => 'Edit category',
            'button' => 'Update',
        ];
        $data = compact('category','title');
        return view('admin.newcategory')->with($data);
    }

    public function showEditPost(Request $request){
        $post = Post::where('post_id','=',$request['id'])->get()->toArray();
        $title = [
            'title' => 'Edit post',
            'button' => 'Update',
        ];
        $data = compact('post','title');
        return view('admin.newpost')->with($data);
    }

    public function editPerson(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);

        Person::where('person_id','=',$id)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => sha1($request['password']),
            'role' => $request['role'],
        ]);

        return redirect('/admin/persons-data');
    }

    public function editCategory(Request $request,$id){
        $request->validate([
            'name' => 'required',
        ]);

        Category::where('category_id','=',$id)->update([
            'name' => $request['name'],
        ]);

        return redirect('/admin/category-data');
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

        // SlugService::createSlug(Post::class, 'slug', $request['title']);

        return redirect('/admin/posts-data');
    }

    public function showNewPerson(){
        $person = [];
        $title = [
            'title' => 'Create new user',
            'button' => 'Create',
        ];
        $data = compact('person','title');
        return view('admin.newperson')->with($data);
    }

    public function showNewCategory(){
        $category = [];
        $title = [
            'title' => 'Create new category',
            'button' => 'Create',
        ];
        $data = compact('category','title');
        return view('admin.newcategory')->with($data);
    }

    public function showNewPost(){
        $post = [];
        $title = [
            'title' => 'Create new post',
            'button' => 'Create',
        ];
        $categories = Category::get()->toArray();
        $data = compact('post','title','categories');
        return view('admin.newpost')->with($data);
    }

    public function newPerson(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);

        $person = new Person();
        $person->name = $request['name'];
        $person->email = $request['email'];
        $person->password = sha1($request['password']);
        $person->role = $request['role'];
        $person->save();

        return redirect('/admin/persons-data');
    }

    public function newCategory(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $category = new Category();
        $category->name = $request['name'];
        $category->save();

        return redirect('/admin/category-data');
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

        // SlugService::createSlug(Post::class, 'slug', $request['title']);

        return redirect('/admin/posts-data');
    }

    public function deletePerson($id){
        Person::where('person_id','=',$id)->delete();

        return redirect('/admin/persons-data');
    }

    public function deleteCategory($id){
        Category::where('category_id','=',$id)->delete();
        return redirect('/admin/category-data');
    }

    public function deletePost($id){
        Post::where('post_id','=',$id)->delete();
        return redirect('/admin/posts-data');
    }

    public function deleteComment($id){
        Comment::where('comment_id','=',$id)->delete();
        return redirect('/admin/comments-data');
    }

    public function searchPerson(Request $request){
        if ($request['search-item'] == 'name'){
            $persons = Person::where('name', 'like', '%'.$request['search'].'%')->get()->toArray();
        }else{
            $persons = Person::where('email', 'like', '%'.$request['search'].'%')->get()->toArray();
        }

        $data = compact('persons');
        return view('admin.usersdata')->with($data);
    }

    public function searchCategory(Request $request){
        $categories = Category::where('name', 'like', '%'.$request['search'].'%')->get()->toArray();
        $data = compact('categories');
        return view('admin.categorydata')->with($data);
    }

    public function searchPost(Request $request){
        if ($request['search-item'] == 'title'){
            $posts = Post::with(['category','person'])->where('title','like','%'.$request['search'].'%')->get()->toArray();
        }else{
            $posts = Post::with(['category','person'])->where('description','like','%'.$request['search'].'%')->get()->toArray();
        }
        $data = compact('posts');
        return view('admin.postsdata')->with($data);
    }

    public function searchComment(Request $request){
        $comments = Comment::where('title', 'like', '%'.$request['search'].'%')->get()->toArray();
        $data = compact('comments');
        return view('admin.commentsdata')->with($data);
    }
}
