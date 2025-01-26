<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FormPostRequest;

class BlogController extends Controller
{
    public function create(): View
    {
        $post = new Post();

        // Retourner la vue de création d'article
        return view("blog.create", [
            "post" => $post,
            "categories" => Category::select("id", "name")->get(),
            "tags" => Tag::select("id", "name")->get(),
        ]);
    }

    public function store(FormPostRequest $request)
    {
        $post = Post::create($request->validated());
        $post->tags()->sync($request->validated("tags"));

        return redirect()->route("blog.show", [
            "slug" => $post->slug,
            "post" => $post->id
        ])->with("success", "Article créer avec succès !");
    }

    public function edit(Post $post): View
    {
        return view("blog.edit", [
            "post" => $post,
            "categories" => Category::select("id", "name")->get(),
            "tags" => Tag::select("id", "name")->get(),
        ]);
    }

    public function update(Post $post, FormPostRequest $request)
    {
        $post->update($request->validated());
        $post->tags()->sync($request->validated("tags"));

        return redirect()->route("blog.show", [
            "slug" => $post->slug,
            "post" => $post->id
        ])->with("success", "Article modifié avec succès !");
    }

    public function index(): View
    {
        return view("blog.index", [
            "posts" => Post::with("tags", "category")->paginate(10),
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
