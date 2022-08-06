<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <title>Criar Enquete</title>

        <script>
        let counter = 3

        function addField() {
            let parent = document.getElementById('form-container');
            let div = document.createElement("div");
            let label = document.createElement("label");
            label.for = `respostas[${counter}]`;
            label.innerHTML = `Resposta ${counter}`;
            label.classList.add("block");
            let input = document.createElement("input");
            input.type = "text";
            input.name = `respostas[${counter}]`;
            input.classList.add(..."rounded px-1 border-black border".split(' '))
            counter++
            div.appendChild(label);
            div.appendChild(input);
            parent.appendChild(div);
        }

        </script>
    </head>
    <body>
        <div class="flex min-h-screen text-xl">

            <form class="m-auto rounded border border-black p-8" action="{{ route('enquetes.store') }}" method="POST">
            <div class="sticky top-0 left-0">
                <a href="{{ route('enquetes.index') }}">
                     <button class="rounded bg-black text-white p-1" type="button">Voltar</button>
                </a>
            </div>
            @csrf
            <div class="grid gap-2 container grid-cols-3" id="form-container">
                <div class="col-span-3 text-center">
                    <button type="button" class="bg-black text-white rounded px-2 py-1" onclick="addField()">Adicionar Resposta</button>
                </div>
                <div>
                    <label class="block" for="titulo">Titulo da enquete</label>
                    <input class="rounded px-1 border-black border" type="text" name="titulo">
                    @error('titulo')
                        <div class="text-red-600 text-sm">Titulo nao pode ser vazio.</div>
                    @enderror
                </div>
                <div>
                    <label class="block" for="inicio">Data de inicio</label>
                    <input class="rounded px-1 border-black border" type="date" name="inicio" value={{ date('Y-m-d') }}>
                    @error('inicio')
                        <p class="text-red-600 text-sm">Data de inicio nao pode ser vazio</p>
                    @enderror
                </div>
                <div>
                    <label class="block" for="termino">Date de termino</label>
                    <input class="rounded px-1 border-black border" type="date" name="termino" value={{ date('Y-m-d') }}>
                    @error('termino')
                        <p class="text-red-600 text-sm">Data de temrino nao pode ser vazio</p>
                    @enderror
                </div>
                <div>
                    <label class="block" for="respostas[0]">Resposta 1</label>
                    <input class="rounded px-1 border-black border" type="text" name="respostas[0]">
                    @error('respostas.0')
                        <p class="text-red-600 text-sm">Resposta 1 nao pode ser vazia</p>
                    @enderror
                </div>
                <div>
                    <label class="block" for="respostas[1]">Resposta 2</label>
                    <input class="rounded px-1 border-black border" type="text" name="respostas[1]">
                    @error('respostas.1')
                        <p class="text-red-600 text-sm">Resposta 2 nao pode ser vazia</p>
                    @enderror
                </div>
                <div>
                    <label class="block" for="respostas[2]">Resposta 3</label>
                    <input class="rounded px-1 border-black border" type="text" name="respostas[2]">
                    @error('respostas.2')
                        <p class="text-red-600 text-sm">Resposta 3 nao pode ser vazia</p>
                    @enderror
                </div>
            </div>
            <button class="px-2 py-1 mt-2 rounded bg-black text-white" type="submit">Criar Enquete</button>
            </form>
        </div>
    </body>
</html>
