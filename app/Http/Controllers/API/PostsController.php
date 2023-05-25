<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Posts::all()->toArray();
        return array_reverse($posts);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'situation' => 'required'
        ]);

        $input = $request->all();

        Posts::create($input);

        return response()->json(['success'=> 'Criado corretamente']);

    }
    public function edit($id)
    {
        $post = Posts::find($id);
        return response()->json($post);
    }

    public function update($id, Request $request)
    {
        $post = Posts::find($id);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'situation' => 'required'
        ]);

        $input = $request->all();
        
        $post->update($input);

        return response()->json(['success'=> 'Atualizado!!!']);
    }

    public function delete($id)
    {
        $post = Posts::find($id);
        $post->delete();
        return response()->json(['success'=> 'Tarefa deletada!']);

    }
   
   
    
}
//Lembrar de tornar OBRIGATÓRIO as informações
//colcoar na orderm que for adicionando