<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js' ])
        <title>Votar Enquete</title>
    </head>
    <body>
        <div class="flex min-h-screen">
            <div class="container m-auto text-xl">
                <div class="text-center my-2">
                    <span class="py-2">{{ $enquete->titulo }}</span>
                    <p class="py-2">
                        {{ date_format(date_create($enquete->inicio), 'm-Y') }} ~ {{ date_format(date_create($enquete->termino), 'd-m-Y') }}
                    </p>
                </div>
                <table class="m-auto">
                    <thead>
                        <tr>
                            <th class="px-8 py-1 border border-black">Resposta</th>
                            <th class="px-8 py-1 border border-black">Votos</th>
                            @if (date('Y-m-d') >= $enquete->inicio and date('Y-m-d') <= $enquete->termino)
                                <th class="px-8 py-1 border border-black"></th>
                            @endif
                        </tr>
                    </thead>
                    @foreach ($respostas as $resposta)
                        <tr>
                            <td class="px-8 py-1 border border-black">{{ $resposta["texto"] }}</td>
                            <td id="{{ $resposta["id"] }}" class="px-8 py-1 border border-black">{{ $resposta["votos"] }}</td>
                            @if (date('Y-m-d') >= $enquete->inicio and date('Y-m-d') <= $enquete->termino)
                                <td class="px-8 py-1 border border-black">
                                    <form action="{{ route('enquetes.update', $enquete->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="resposta_id" value="{{ $resposta["id"] }}">
                                        <button class="rounded bg-black text-white p-1">Votar</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    <tr>
                        <td>
                            <a href="{{ route('enquetes.index') }}">
                                <button class="rounded bg-black text-white p-1 m-1">Home</button>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>
