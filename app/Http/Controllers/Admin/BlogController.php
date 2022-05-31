<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\blog;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = blog::all();
        return view('admin.blog.list',compact('data'));
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
    public function store(BlogRequest $request)
    {
        $data = new blog();
        $data->title = $request->title;
        $file = $request->file;
        $data['image'] = $file->getClientOriginalName();
        $file->move('blog',$file->getClientOriginalName());
        $data->description = $request->description;
        $data->content = $request->content;
        $data->save();
        return view('admin.blog.add');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Blog::where('id',$id)->get();
        // dd($data);
        $data = $data[0];
        return view('admin.blog.edit',compact('data'));
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
    public function update(BlogRequest $request, $id)
    {
        $title = $request->title;
        $description = $request->description;
        $content = $request->content;
        $file = $request->file;
        if(!empty($file)){
            $file = $file->getClientOriginalName();
        }

        if(blog::where('id',$id)->update(['title'=>$title,'description'=>$description,'content'=>$content,'image'=>$file])){
            if(!empty($file)){
                $file->move('blog',$file->getClientOriginalName());
            }
            return redirect()->back()->with('success',__('Edit blog success'));
        }
        else {
            return redirect()->back()->withErrors('Edit blog errors');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = blog::where('id',$id)->delete();
        return redirect()->back();
    }
}
