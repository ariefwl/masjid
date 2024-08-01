<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        // Get all post
        $posts = Post::latest()->paginate(5);

        //return collection of post as a resource
        return new PostResource(true, 'list data post', $posts);
    }

    public function store(Request $request)
    {
         //define validation rules
         $validator = Validator::make($request->all(), [
            // 'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image'     => 'required',
            'title'     => 'required',
            'content'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/posts', $image->hashName());

        //create post
        $post = Post::create([
            // 'image'     => $image->hashName(),
            'image'     => $request->image,
            'title'     => $request->title,
            'content'   => $request->content,
        ]);

        //return response
        return new PostResource(true, 'Data Post Berhasil Ditambahkan!', $post);
    }
}
