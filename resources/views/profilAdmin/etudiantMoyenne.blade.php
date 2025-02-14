@extends('template.parent')

@section('content')
<div class="container">
    <h1>Liste des Étudiants pour le Semestre ID: {{ $semestreId }}</h1>

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
                    <th>Rang</th> <!-- Ajout de la colonne Rang -->
                    <th>ID Étudiant</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Moyenne</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($etudiants as $etudiant)
                    <tr>
                        <td>{{ $etudiant->rang }}</td> <!-- Affichage du rang -->
                        <td>{{ $etudiant->idetudiant }}</td>
                        <td>{{ $etudiant->nom }}</td>
                        <td>{{ $etudiant->prenom }}</td>
                        <td>{{ number_format($etudiant->moyenne, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Aucun étudiant trouvé pour ce semestre</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
