<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function fetchPosts()
    {
        $url = 'http://localhost:8000/public/posts';

        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'Error occurred while fetching data'], 500);
        }

        $data = $response->json();
        Log::info('JSON Response: ' . json_encode($data));

        $posts = $data;

        return view('posts/index', compact('posts'));

    }

    public function showPosts($id) 
    {
        $url = 'http://localhost:8000/public/posts/' . $id;

        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'Error occurred while fetching data'], 500);
        }

        $data = $response->json();
        Log::info('JSON Response: ' . json_encode($data));

        $post = $data['data'];

        // dd($post);        
        return view('posts/show', compact('post'));
    }


}
