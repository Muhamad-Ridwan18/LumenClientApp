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

    public function fetchPostsWithXml()
    {
        $url = 'http://localhost:8000/public/posts';

        $response = Http::withHeaders([
            'Accept' => 'application/xml',
        ])->get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'Error occurred while fetching data'], 500);
        }

        $contentType = $response->header('Content-Type');

        if ($contentType === 'application/xml') {
            $xmlData = simplexml_load_string($response->body(), null, LIBXML_NOCDATA);
            $jsonData = json_encode($xmlData);
            $data = json_decode($jsonData, true);
            Log::info('XML Response: ' . $jsonData);
        } else {
            return response()->json(['error' => 'Unsupported Content-Type'], 406);
        }

        $posts = $data['post']; 

        return view('posts/index', compact('posts'));
    }

    public function fetchPostsWithJson()
    {
        $url = 'http://localhost:8000/public/posts';

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'Error occurred while fetching data'], 500);
        }

        $data = $response->json();
        $posts = $data['data']; 
        // dd($posts);
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
  
        return view('posts/show', compact('post'));
    }
}
