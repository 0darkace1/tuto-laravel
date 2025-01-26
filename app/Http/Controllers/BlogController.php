<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FormPostRequest;
use App\Models\Category;

class BlogController extends Controller
{
    public function create(): View
    {
        $post = new Post();

        // Retourner la vue de création d'article
        return view("blog.create", [
            "post" => $post
        ]);
    }

    public function store(FormPostRequest $request)
    {
        $post = Post::create($request->validated());

        return redirect()->route("blog.show", [
            "slug" => $post->slug,
            "post" => $post->id
        ])->with("success", "Article créé avec succès !");
    }

    public function edit(Post $post): View
    {
        return view("blog.edit", [
            "post" => $post,
        ]);
    }

    public function update(Post $post, FormPostRequest $request)
    {
        $post->update($request->validated());

        return redirect()->route("blog.show", [
            "slug" => $post->slug,
            "post" => $post->id
        ])->with("success", "Article modifié avec succès !");
    }

    public function index(): View
    {
        // Récupérer et Retourner les articles sous forme de json
        return view("blog.index", [
            "posts" => Post::paginate(1),
        ]);
    }

    public function show(string $slug, Post $post): RedirectResponse | View
    {
        // Rediriger vers le bon url si le slug est incorrect
        if ($post->slug !== $slug) {
            return to_route("blog.show", [
                "slug" => $post->slug,
                "id" => $post->id
            ]);
        }

        // Retourner l'article
        return view("blog.show", [
            "post" => $post,
        ]);
    }
}
