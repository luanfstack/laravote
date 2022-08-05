<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <title>Votar Enquete</title>
    </head>
    <body>
        <div class="flex min-h-screen">
            <div class="container m-auto">
                <div class="text-center">
                    {{ $enquete->titulo }} - {{ date_format(date_create($enquete->inicio), 'd-m-Y') }} - {{ date_format(date_create($enquete->termino), 'd-m-Y') }}
                </div>
                <table class="m-auto">
                    <thead>
                        <tr>
                            <th>Resposta</th>
                            <th>Votos</th>
                            @if (date('Y-m-d') >= $enquete->inicio and date('Y-m-d') <= $enquete->termino)
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    @foreach ($respostas as $resposta)
                        <tr>
                            <td>{{ $resposta["resposta"] }}</td>
                            <td>{{ $resposta["votes"] }}</td>
                            @if (date('Y-m-d') >= $enquete->inicio and date('Y-m-d') <= $enquete->termino)
                                <td>
                                    <form action="{{ route('enquetes.update', $enquete->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="resposta_id" value="{{ $resposta["id"] }}">
                                        <button>Votar</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </body>
</html>
