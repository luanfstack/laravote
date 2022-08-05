<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <title>Ver Enquetes</title>
    </head>
    <body>
        <div class="flex min-h-screen">
            <div class="m-auto bg-red-500">
                @if (count($enquetes) == 0)
                    <div class="text-center">
                        <p class="">Nenhuma Enquete</p>
                    </div>
                @else
                <table class="table-auto m-auto">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Inicio</th>
                            <th>Termino</th>
                            <th>
                                <a href="/enquetes/create">
                                    <button class="bg-black text-white rounded px-2 py1">Criar Nova Enquete</button>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enquetes as $enquete)
                            <tr>
                                <td>{{ $enquete->titulo }}</td>
                                <td>{{ date_format(date_create($enquete->inicio), 'd-m-Y') }}</td>
                                <td>{{ date_format(date_create($enquete->termino), 'd-m-Y') }}</td>
                                <td>
                                    <form action="{{ route('enquetes.destroy',$enquete->id) }}" method="Post">
                                    <a href="{{ route('enquetes.show',$enquete->id) }}">Ver</a>
                                    @if (date('Y-m-d') < $enquete->inicio )
                                        <a href="{{ route('enquetes.edit',$enquete->id) }}">Editar</a>
                                    @endif
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Deletar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </body>
</html>
