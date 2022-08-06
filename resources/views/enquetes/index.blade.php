<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <title>Enquetes</title>
    </head>
    <body>
        <div class="flex min-h-screen">
            <div class="m-auto text-xl text-center">
                @if (count($enquetes) == 0)
                    <div>
                        <p>Nenhuma Enquete</p>
                        <a href="/enquetes/create">
                            <button class="bg-blue-600 text-white rounded p-1 m-1">Criar Nova Enquete</button>
                        </a>
                    </div>
                @else
                <table>
                    <thead>
                        <tr>
                            <th class="border border-black">Titulo</th>
                            <th class="border border-black">Inicio</th>
                            <th class="border border-black">Termino</th>
                            <th class="border border-black">
                                <a href="/enquetes/create">
                                    <button class="bg-blue-600 text-white rounded p-1 m-1">Criar Nova Enquete</button>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enquetes as $enquete)
                            <tr>
                                <td class="px-8 py-1 border border-black">{{ $enquete->titulo }}</td>
                                <td class="px-8 py-1 border border-black">{{ date_format(date_create($enquete->inicio), 'd-M-Y') }}</td>
                                <td class="px-8 py-1 border border-black">{{ date_format(date_create($enquete->termino), 'd-M-Y') }}</td>
                                <td class="px-8 py-1 border border-black">
                                    <form action="{{ route('enquetes.destroy',$enquete->id) }}" method="Post">
                                    <a href="{{ route('enquetes.show',$enquete->id) }}">
                                        <button type="button" class="bg-green-600 rounded text-white p-1 mx-1 w-16">Ver</button>
                                    </a>
                                    @if (date('Y-m-d') < $enquete->inicio )
                                        <a href="{{ route('enquetes.edit',$enquete->id) }}">
                                            <button type="button" class="bg-yellow-300 rounded p-1 m-1 w-16">Editar</button>
                                        </a>
                                    @endif
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-600 rounded text-white p-1 mx-1" type="submit">Deletar</button>
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
