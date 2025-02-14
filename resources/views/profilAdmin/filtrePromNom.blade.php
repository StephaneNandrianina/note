@extends('template.parent')

@section('title', 'filtre Par prom et nom')

@section('content')
<h1>page liste des étudiants (avec filtre par promotion,nom)</h1>
<form class="forms-sample" action="{{route('filtrer.etudiant')}}" method="get">
                @error("error")
                      {{$message}}
                    @enderror

                
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Select</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" id="promotion" name="promotion">
                    <option selected>liste des promotion</option>
                    
                      @foreach($promotions as $promotion)                                      
                        <option value="{{ $promotion->idpromotion}}">{{ $promotion->nompromotion}}</option>
                      @endforeach
                    </select>
                    
                  </div>
                </div>
                
                <div class="form-group">
                    <label for="marque">nom de l'etudiant :</label>
                    <input type="text" id="mot" name="mot" class="form-control" required>
                </div>
                
              <button type="submit" class="btn btn-primary me-2">OK</button>
            </form>

            <div class="container">
        <h1>Liste des etudiants</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Numero ETU </th>
                    <th>Nom  </th>
                    <th>Prenom</th>
                    <th>Date de naissance</th>
                    <th>Nom promotion</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($listeRechercheEtudiant as $listeLap)
                    <tr>
                        <td>{{ $listeLap->numetu }}</td>
                        <td>{{ $listeLap->nom }}</td>
                        <td>{{ $listeLap->prenom }}</td>
                        <td>{{ $listeLap->datedenaissance }}</td>                        
                        <td>{{ $listeLap->nompromotion }}</td>
                        <td>
                          
                        <a href="{{route('liste.semestre', ['idetudiant' => $listeLap->idetudiant,'idsemestre' => $listeLap->idsemestre])}}" type="button" class="btn btn-outline-primary btn-fw">cliquez pour voir semestre</a>
                        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection