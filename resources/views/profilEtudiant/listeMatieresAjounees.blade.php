@extends('template.nice') <!-- Utilisez le layout de votre application, modifiez si nécessaire -->

@section('content')
<div class="container">
    <h1>Liste des Matières Ajournées</h1>
    
    <!-- Affichage des erreurs éventuelles -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Affichage des informations de l'étudiant -->
    <div class="card mb-3">
        <div class="card-header">
            Étudiant : {{ $etudiant->nom }} {{ $etudiant->prenom }}
        </div>
        <div class="card-body">
            <p>ID : {{ $etudiant->idetudiant }}</p>
            <p>Email : {{ $etudiant->numetu }}</p>
        </div>
    </div>

    <!-- Affichage de la liste des matières ajournées -->
    @if($matieresAjourees->isEmpty())
        <p>Aucune matière ajournée.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Code Matière</th>
                    <th>Nom Matière</th>
                </tr>
            </thead>
            <tbody>
                @foreach($matieresAjourees as $matiere)
                    <tr>
                        <td>{{ $matiere->codematiere }}</td>
                        <td>{{ $matiere->nommatiere }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Affichage du montant total pour les rattrapages -->
    <div class="mt-4">
        <h4>Montant total pour les rattrapages : {{ number_format($montantTotalRattrapage, 0, ',', ' ') }} ariary</h4>
    </div>
</div>
@endsection
