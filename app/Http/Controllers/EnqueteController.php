<?php

namespace App\Http\Controllers;
use App\Models\Enquete;
use App\Models\Resposta;
use Illuminate\Http\Request;
use App\Events\Voted;


class EnqueteController extends Controller
{
    public function index(){
        $enquetes = Enquete::orderBy('id', 'desc')->get();
        return view('enquetes.index', compact('enquetes'));
    }

    public function create(){
        return view('enquetes.create');
    }

    public function store(Request $request){
        $request->validate([
            'titulo' => 'required',
            'inicio' => 'required',
            'termino' => 'required',
            'respostas.*' => 'required',
        ]);
        $enquete = Enquete::create([
            'titulo' => $request->get('titulo'),
            'inicio' => $request->get('inicio'),
            'termino' => $request->get('termino'),
        ]);
        foreach($request->get('respostas') as $texto){
            Resposta::create([
                'enquete_id' => $enquete->id,
                'texto' => $texto,
                'votos' => 0,
            ]);
        }
        return redirect()->route('enquetes.index');
    }

    public function show(Enquete $enquete){
        $respostas = Resposta::where('enquete_id', $enquete->id)->get()->toArray();
        return view('enquetes.show', compact('enquete', 'respostas'));
    }

    public function edit(Enquete $enquete){
        $respostas = Resposta::where('enquete_id', $enquete->id)->get()->toArray();
        return view('enquetes.edit', compact('enquete', 'respostas'));
    }

    public function update(Request $request, Enquete $enquete){
        if($request->get('resposta_id')){
            Voted::dispatch($request->get('resposta_id'));
            Resposta::where('id', $request->get('resposta_id'))->increment('votos');
            return redirect()->route('enquetes.show', $enquete->id);
        }
        $request->validate([
            'titulo' => 'required',
            'inicio' => 'required',
            'termino' => 'required',
            'respostas.*' => 'required',
        ]);
        foreach($request->get('respostas') as $id => $texto){
            Resposta::where('id', $id)->update(['texto' => $texto]);
        }
        $enquete->fill([
            'titulo' => $request->get('titulo'),
            'inicio' => $request->get('inicio'),
            'termino' => $request->get('termino'),
        ])->save();
        return redirect()->route('enquetes.index');
    }

    public function destroy(Enquete $enquete){
        $enquete->delete();
        return redirect()->route('enquetes.index');
    }
}
