@extends('template.parent')

@section('title', 'Liste des semestres')

@section('content')
    <div class="container">
        <h1>Liste des semestres</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Rang</th>
                    <th>ID Semestre</th>
                    <th>Nom Semestre</th>
                    <th>Moyenne Générale</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listeSemestres as $liste)
                    <tr>
                        <td>{{ $liste->rang }}</td>
                        <td>{{ $liste->idsemestre }}</td>
                        <td>{{ $liste->nomsemestre }}</td>
                        <td>{{ number_format($liste->moyennegenerale, 2) }}</td>
                        
                        <td>
                            <a href="{{ route('notes-etudiant', ['etudiantId' => $etudiantId, 'semestreId' => $liste->idsemestre]) }}" type="button" class="btn btn-outline-primary btn-fw">Voir les notes</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
