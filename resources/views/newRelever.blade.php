@extends('template.parent')

@section('content')
<style>
    .table-custom {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
    }

    .table-custom th, .table-custom td {
        padding: 0.75rem;
        vertical-align: top;
        border: 1px solid #dee2e6;
    }

    .table-custom thead th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: bold;
    }

    .table-custom tbody tr.etat-valide {
        background-color: #d4edda !important; /* Vert clair pour les matières validées */
        color: #155724 !important; /* Texte en vert foncé */
    }

    .table-custom tbody tr.etat-ajournee {
        background-color: #f8d7da !important; /* Rouge clair pour les matières ajournées */
        color: #721c24 !important; /* Texte en rouge foncé */
    }

    .table-custom tbody tr.etat-compensee {
        background-color: #e2e3e5 !important; /* Gris clair pour les matières compensées */
        color: #6c757d !important; /* Texte en gris foncé */
    }

    .table-custom tbody tr.etat-non-evalue {
        background-color: #fff !important; /* Blanc pour les matières non évaluées */
        color: #000 !important; /* Texte en noir */
    }
</style>

<div class="container">
    <h1>Notes pour l'Étudiant : {{ $etudiant->nom }} {{ $etudiant->prenom }}</h1>

    <h2>Moyenne Générale: {{ number_format($moyenneGenerale, 2) }}</h2>
    <h2>Crédits Obtenus: {{ $creditsObtenus }}</h2>
    <h2>Mention: {{ ucfirst($mention) }}</h2>

    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Matière</th>
                    <th>Code</th>
                    <th>Note</th>
                    <th>État</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bestNotes as $note)
                    @php
                        $matiere = $matieres->firstWhere('idmatiere', $note->idmatiere);
                        $etat = isset($resultats[$note->idmatiere]) ? $resultats[$note->idmatiere] : 'non évalué';
                    @endphp
                    <tr class="
                        @switch($etat)
                            @case('valide')
                                etat-valide
                                @break
                            @case('ajournée')
                                etat-ajournee
                                @break
                            @case('compensée')
                                etat-compensee
                                @break
                            @default
                                etat-non-evalue
                        @endswitch
                    ">
                        <td>{{ $matiere->nommatiere ?? 'Matière inconnue' }}</td>
                        <td>{{ $matiere->codematiere ?? 'Code inconnu' }}</td>
                        <td>{{ number_format($note->valeur, 2) }}</td>
                        <td>{{ ucfirst($etat) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Aucune note disponible pour ce semestre</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
