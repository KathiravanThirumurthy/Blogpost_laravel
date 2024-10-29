<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts, 200);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
        // saves the data in the dabtabase
        $post = Post::create($validatedData);
        return response()->json($post, 201);

    }
    public function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            return response()->json($post, 200);
        } else {
            return response()->json(['error' => 'Post not found'], 404);
        }

    }
    public function update(Request $request,$id)
    {
        $post = Post::find($id);
        if ($post) {
            $validatedData = $request->validate([
                'title' => 'required|string',
                'content' => 'required|string',

            ]);


            $post->update($validatedData);
            return response()->json($post, 200);
        } else {
            return response()->json(['error' => 'Student not found'], 404);
        }


    }
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return response()->json(['message' => 'Student deleted'], 200);
        } else {
            return response()->json(['error' => 'Student not found'], 404);
        }

    }

}
