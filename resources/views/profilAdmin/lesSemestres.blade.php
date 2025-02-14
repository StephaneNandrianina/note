@extends('template.parent')

@section('content')
<div class="container">
    <h1>Liste des Semestres</h1>

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

    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>ID Semestre</th>
                    <th>Nom Semestre</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semestres as $semestre)
                    <tr>
                        <td>{{ $semestre->idsemestre }}</td>
                        <td>
                            <!-- Lien vers la liste des étudiants avec leurs moyennes pour le semestre cliqué -->
                            <a href="{{ route('etudiants.liste', $semestre->idsemestre) }}">{{ $semestre->nomsemestre }}</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Aucun semestre trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
