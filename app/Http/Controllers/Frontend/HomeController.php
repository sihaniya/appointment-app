<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        // $articles = Article::where("status", 1)->get();, compact('articles')
        return view('frontend.home');
    }

    public function detail($slug)
    {
        $article = Article::where("slug", $slug)->first();
        return view('frontend.detail', compact('article'));
    }

    public function fetch($id)
    {
        $comments = Comment::where("article_id", $id)->get();
        $data = array(
            "data" => $comments,
            "success" => true
        );
        return response()->json($data)->setStatusCode(Response::HTTP_OK);
    }

    public function save_comment(Request $request, $id)
    {
        $data = array();
        $validator = Validator::make($request->all(), [
            "name" => 'required',
            "email" => 'required|email',
            "message" => 'required',
        ]);

        if ($validator->passes()) {
            $comment = new Comment();
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->message = $request->message;
            $comment->article_id = $id;
            $comment->save();

            $data = array(
                "message" => 'Comment added successfully.',
                "success" => true
            );
            return response()->json($data)->setStatusCode(Response::HTTP_CREATED);
        }
        return response()->json(array("success" => false, "type" => 'validation', 'errors' => $validator->messages()))
            ->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY, Response::$statusTexts[Response::HTTP_UNPROCESSABLE_ENTITY]);
    }
}