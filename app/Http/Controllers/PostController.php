<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = \App\Post::paginate(20);

        return view('cms.post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cms.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:60',
            'description' => 'required',
            'image_path' => 'mimes:jpeg,bmp,png',
            'like_num' => 'required',
        ]);
        $image_path = '';
        if ($request->hasFile('image_path')) {
            if ($request->file('image_path')->getError() != 0) {
                return Response(['image_path' => $request->file('image_path')->getErrorMessage()], 422);
            }
            $file = $request->file('image_path');

            $entension = $file->getClientOriginalExtension();
            $file_name = uniqid().'.'.$entension;
            $path = 'uploads/posts/';
            $file->move(public_path($path), $file_name);
            $image_path = $path.$file_name;
        } else {
            return Response(['image_path' => '预览图不能为空'], 422);
        }
        $post = new \App\Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->like_num = $request->input('like_num');
        $post->image_path = $image_path;
        $post->save();

        return ['ret' => 0];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = \App\Post::find($id);

        return view('cms.post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:60',
            'description' => 'required',
            'image_path' => 'mimes:jpeg,bmp,png',
            'like_num' => 'required',
        ]);
        $post = \App\Post::find($id);
        $image_path = $post->image_path;
        if ($request->hasFile('image_path')) {
            if ($request->file('image_path')->getError() != 0) {
                return Response(['image_path' => $request->file('image_path')->getErrorMessage()], 422);
            }
            $file = $request->file('image_path');

            $entension = $file->getClientOriginalExtension();
            $file_name = uniqid().'.'.$entension;
            $path = 'uploads/posts/';
            $file->move(public_path($path), $file_name);
            $image_path = $path.$file_name;
        }
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->like_num = $request->input('like_num');
        $post->image_path = $image_path;
        $post->save();

        return ['ret' => 0];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Post::destroy($id);

        return ['ret' => 0, 'msg' => ''];
    }
}
