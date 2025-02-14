@extends('template.nice')

@section('title', 'liste de ses semestres')

@section('content')
    <div class="container">
        <h1>Liste des semestres du numéro {{ session()->get('name') }}</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>idSemestre</th>
                    <th>nom semestre</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listeSemestres as $ca)
                    <tr>
                        <td>{{ $ca->idsemestre }}</td>
                        <td>{{ $ca->nomsemestre }}</td>
                        <td>
                            @if(isset($ca->idetudiant))
                                <a href="{{ route('notes-etudiant', ['etudiantId' => $ca->idetudiant, 'semestreId' => $ca->idsemestre]) }}" type="button" class="btn btn-outline-primary btn-fw">
                                    cliquez pour voir relevé
                                </a>
                            @else
                                <span class="text-muted">Données manquantes</span>
                            @endif
                        </td>
                        <td>
                            @if(isset($ca->idetudiant))
                                <a href="{{ route('matieres.ajounees', ['etudiantId' => $ca->idetudiant, 'semestreId' => $ca->idsemestre]) }}" class="btn btn-outline-danger btn-fw">
                                    Voir les matières ajournées
                                </a>
                            @else
                                <span class="text-muted">Données manquantes</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
