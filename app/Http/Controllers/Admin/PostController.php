<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Creo le richieste di validazione
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);


        // recupero i dati dal form
        $newPost = $request->all();
        
        // imposto lo slug dal titolo verificando che non sia già presente nella tabella essendo questo univoco
        $baseSlug = Str::slug($newPost['title'], '-');

        $newSlug = $baseSlug;
        $counter = 0;
        while(Post::where('slug', $newSlug)->first()){
            $counter++;
            $newSlug = $baseSlug . '-' . $counter;
        }

        $newPost['slug'] = $newSlug;
        
        // creo la nuova istanza per inviare i dati al DB
        $upPost = new Post();

        // Invio i dati e li salvo nel DB
        $upPost->fill($newPost);
        $upPost->save();

        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Creo le richieste di validazione
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);

        // recupero i dati dal form
        $editPost = $request->all();

        // preparo l'eventuale nuovo slug verificando che non sia già presente nella tabella essendo questo univoco
        $editSlug = Str::slug($editPost['title'], '-');
        if($editSlug != $post->slug){

            $newEditSlug = $editSlug;
            $counter = 0;
            while(Post::where('slug', $newEditSlug)->first()){
                $counter++;
                $newEditSlug = $editSlug . '-' . $counter;
            }
            $editPost['slug'] = $newEditSlug;
        }


        // carico le modifiche nel DB
        $post->update($editPost);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
