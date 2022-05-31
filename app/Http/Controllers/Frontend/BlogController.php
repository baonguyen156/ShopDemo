<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\rate;
use App\Models\comment;
use Auth;
use App\Models\User;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = blog::orderby('id','DESC')->paginate(3);
        return view('frontend.blog.list',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $previous = blog::where('id', '<', $id)->max('id');
        $next = blog::where('id', '>', $id)->min('id');
        $rate = rate::where('blog_id',$id)->avg('point');
        $rate = round($rate,1);
        
        $getBlogDetail = blog::find($id);
        
        // with(['comment' => function ($q) {
        //     $q->orderBy('id', 'asc');
            
        // }])->find($id);

        $comments = comment::with('replies')->where([['level','=',0],['idblog',$id],])->get();

        return view('frontend.blog.blog-single',compact('comments','getBlogDetail','previous','next','rate'));
    }
    public function comment(Request $request ,$id)
    {
        $comment = new comment();
        $comment->cmt = $request->cmt;
        $comment->idblog = $id;
        $comment->iduser = Auth::id();
        $comment->level = $request->level;
        $comment->name = Auth::user()->name;
        $comment->avatar = Auth::user()->avatar;
        $comment->save();
        return redirect()->back();
    }
    public function showcomment()
    {
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function ajaxrate()
    // {
    //     return view('frontend.blog.ajax');
    // }

    public function rate(Request $request)
    {
        $data = new rate();
        $data->point = $request->value;
        $data->blog_id = $request->blogid;
        $data->save();
    }

}
