<?php

namespace App\Http\Controllers;
use App\Models\Enquete;
use Illuminate\Http\Request;

class EnqueteController extends Controller
{
    public function index(){
        $enquetes = Enquete::orderBy('id', 'desc')->get();
        return view('index', compact('enquetes'));
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $request->validate([
            'titulo' => 'required',
            'inicio' => 'required',
            'termino' => 'required',
        ]);
        $enquete = Enquete::create([
            'titulo' => $request->get('titulo'),
            'inicio' => $request->get('inicio'),
            'termino' => $request->get('termino'),
        ]);
        foreach($request->get('respostas') as $resposta){
            Resposta::create([
                'enquete_id' => $enquete->id,
                'resposta' => $resposta,
                'votes' => 0,
            ]);
        }
        return redirect()->route('index')->with('sucesso', 'A enquete foi criada com sucesso.');
    }

    public function show(Enquete $enquete){
        $respostas = Resposta::where('enquete_id', $enquete->id)->get()->toArray();
        return view('show', compact('enquete', 'respostas'));
    }

    public function vote(Resposta $resposta){
        dd($resposta);
        return redirect()->route('index')->with('sucesso', 'Voto realizado com sucesso');
    }

    public function edit(Enquete $enquete){
        return view('edit', compact('enquete'));
    }

    public function update(Request $request, Enquete $enquete){
        $request->validate([
            'titulo' => 'required',
            'inicio' => 'required',
            'termino' => 'required',
        ]);
        $enquete->fill($request->post())->save();
        return redirect()->route('index')->with('sucesso', 'A enquete foi atualizada com sucesso.');
    }

    public function destroy(Enquete $enquete){
        $enquete->delete();
        return redirect()->route('index')->with('sucesso', 'A enquete foi removida com sucesso.');
    }
}
