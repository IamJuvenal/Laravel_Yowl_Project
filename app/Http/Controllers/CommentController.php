<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Comment::all();
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
            'content'=> 'required',
            'user_id'=>'required',
        ]);

        return Comment::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Comment::find($id);
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
        $comment = Comment::find($id);
        $comment = $comment->update($request->all());

        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Comment::destroy($id);
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  str $content
     * @return \Illuminate\Http\Response
     */
    public function search($content)
    {
        return Comment::where('content', 'like', '%'.$content.'%')->get();
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  str $content
     * @return \Illuminate\Http\Response
     */
    public function searchById($id) {
        return Comment::where('user_id', $id)->get();
    }
}
