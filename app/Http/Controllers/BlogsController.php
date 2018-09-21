<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Blog;
use App\User;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'delete', 'yourBlogs']]);
        
        // Alternativly
        //$this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = DB::table('blogs')
            ->join('users', 'blogs.user_id', '=', 'users.id')
            ->select('blogs.*', 'users.firstName', 'users.lastName')
            ->paginate(30);

        //$date = Carbon::parse($blogs[0]->created_at)->diffForHumans();
        return view('blogs.index', compact('blogs', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'body'  => 'required|min:500',
            'cover' => 'image|max:1999',
        ]);
        
        // Handle the cover picture
        if($request->hasFile('cover')) {
            $file = $request->file('cover')->getClientOriginalName();
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $fileExt  = pathinfo($file, PATHINFO_EXTENSION);
            $fileToStore = $fileName . '_' . time() . '.' . $fileExt;

            $request->file('cover')->storeAs('public/cover_pics/', $fileToStore);
        }
        else {
            $fileToStore = 'no-cover-image.jpg';
        }


        $blog = new Blog;
        $blog->title = $request->title;
        $blog->content = $request->body;
        $blog->cover = $fileToStore;
        $blog->user_id = Auth::user()->id; 
        $blog->save();

        return redirect('/blogs/create')->with('msg_success', 'Blog Created Succssfully');
    }

    public function yourBlogs() {
        $user = DB::select("SELECT * FROM users WHERE id = ?", [Auth::user()->id]);
        $blogs = DB::select("SELECT * FROM blogs WHERE user_id = ?", [Auth::user()->id]);

        // getting the total stars of all blogs
        $stars = 0;
        foreach($blogs as $blog) {
            $stars += $blog->stars;
        }

        // getting the profile Image
        $image = '';
        if($user[0]->image == NULL) {
            $image = 'no-image.png';
        } else {
            $image = $user[0]->image;
        }

        return view('blogs.yourBlogs', compact('user', 'blogs', 'stars', 'image'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = DB::table('blogs')
            ->join('users', 'blogs.user_id', '=', 'users.id')
            ->select('blogs.*', 'users.firstName', 'users.lastName')
            ->where('blogs.id', '=', $id)
            ->get();
        $date = Carbon::parse($blog[0]->created_at)->format('d/m/Y');
        return view('blogs.show', compact('blog', 'date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('blogs.edit', compact('blog'));
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
            'title' => 'required|string',
            'body'  => 'required',
            'cover' => 'image|max:1999',
        ]);
        
        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->content = $request->body;

        // Handle the cover picture
        if($request->hasFile('cover')) {
            $file = $request->file('cover')->getClientOriginalName();
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $fileExt  = pathinfo($file, PATHINFO_EXTENSION);
            $fileToStore = $fileName . '_' . time() . '.' . $fileExt;
            $request->file('cover')->storeAs('public/cover_pics/', $fileToStore);

            $blog->cover = $fileToStore;
        }
       
        $blog->save();

        return redirect('/yourBlogs')->with('msg_success', 'Blog Updated Succssfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);

        if(Auth::user()->id != $blog->user_id) {
            return 'This is not your post to delete';
        }

        if($blog->cover != NULL) {
            Storage::delete('public/cover_pics/'.$blog->cover);
        }

        $blog->delete();
        return redirect('/yourBlogs')->with('msg_success', 'Blog Deleted Succssfully');
    }
}
