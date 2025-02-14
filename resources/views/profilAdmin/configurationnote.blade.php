@extends('template.parent')

@section('title', 'Configurer Note')

@section('content')

<div class="container">
    <h1>Configuration Notes</h1>

    <style>
        .table-custom {
            width: 100%;
            border-collapse: collapse;
        }

        .table-custom th, .table-custom td {
            border: 1px solid black; /* Ajoute une bordure noire aux cellules */
            padding: 8px; /* Espace à l'intérieur des cellules */
            text-align: left; /* Alignement du texte à gauche */
        }

        .table-custom th {
            background-color: #f2f2f2; /* Couleur de fond pour les en-têtes */
        }
    </style>

    <table class="table-custom">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Config</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($configurationNotes as $note)
                <tr>
                    <td>{{ $note->idconfigurationnote }}</td>
                    <td>{{ $note->code }}</td>
                    <td>{{ $note->config }}</td>
                    <td>
                        <form action="{{ route('configurationnote.update', $note->idconfigurationnote) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" name="valeur" value="{{ $note->valeur }}">
                            <button type="submit">Modifier</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
