@extends('template.parent')

@section('title', 'Saisi des notes')

@section('content')
<h1>page pour saisir les notes (etudiant, matière, note)
</h1>
<form class="forms-sample" action="{{route('saisi.note')}}" method="get">
                @error("error")
                      {{$message}}
                    @enderror

                
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Select</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" id="etudiant" name="etudiant">
                    <option selected>liste des etudiants</option>
                    
                      @foreach($etudiants as $etudiant)                                      
                        <option value="{{ $etudiant->idetudiant}}">{{ $etudiant->numetu}}</option>
                      @endforeach
                    </select>
                    
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Select</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" id="matiere" name="matiere">
                    <option selected>Liste des matieres</option>
                    
                      @foreach($matieres as $matiere)                                      
                        <option value="{{ $matiere->idmatiere}}">{{ $matiere->nommatiere}}</option>
                      @endforeach
                    </select>
                    
                  </div>
                </div>

                <div class="form-group">
                    <label for="marque">Note :</label>
                    <input type="text" id="note" name="note" class="form-control" required>
                </div>
                

                

                <button type="submit" class="btn btn-primary me-2">OK</button>
            </form>
@endsection