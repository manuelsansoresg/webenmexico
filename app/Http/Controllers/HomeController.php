<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->middleware('auth');
        $comments = Comment::all();
        return view('main', compact('comments'));
    }

    public function comment(Request $request)
    {
        $comment = Comment::saveComment($request);
        return response()->json($comment);
    }

    public function contact(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'g-recaptcha-response' => 'recaptcha',
        ]);
        $error = false;
        // Verificamos si hay algún error
        if($validator->fails()) {
            $error = true;
        }
        return response()->json($error);
    }
}
