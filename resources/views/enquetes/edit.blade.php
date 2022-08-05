<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <title>Editar Enquete</title>
    </head>
    <body>
        <div class="flex min-h-screen text-xl">
            <form class="m-auto" action="{{ route('enquetes.update',$enquete->id) }}" method="POST" enctype="multipart/form-data">
            <div id="form-container" class="grid container grid-cols-3 gap-2 m-auto rounded border border-black p-8">
                @csrf
                @method('PUT')
                <div>
                    <label class="block" for="titulo">Titulo da enquete</label>
                    <input class="rounded border boder-black px-1" type="text" name="titulo" value="{{ $enquete->titulo }}">
                </div>
                @error('titulo')
                    <p class="text-red-600 text-sm">Titulo nao pode ser vazio</p>
                @enderror
                <div>
                    <label class="block" for="inicio">Data de inicio</label>
                    <input class="rounded border boder-black px-1" type="date" name="inicio" value="{{ $enquete->inicio }}">
                </div>
                @error('inicio')
                    <p class="text-red-600 text-sm">Data de inicio nao pode ser vazio</p>
                @enderror
                <div>
                    <label class="block" for="termino">Data de termino</label>
                    <input class="rounded border boder-black px-1" type="date" name="termino" value="{{ $enquete->termino }}">
                </div>
                @error('termino')
                    <p class="text-red-600 text-sm">Data de termino nao pode ser vazio</p>
                @enderror
                @foreach ($respostas as $key => $resposta)
                <div>
                    <label class="block" for="">Resposta {{ $key + 1 }}</label>
                    <input class="rounded border boder-black px-1" type="text" name={{ "respostas[".$resposta["id"]."]" }} value="{{ $resposta["resposta"] }}">
                </div>
                @endforeach
                <div class="col-span-3 text-center">
                    <button class="bg-black text-white rounded p-1" type="submit">Atualizar</button>
                </div>
            </div>
        </form>
        </div>
    </body>
</html>
