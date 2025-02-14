
@extends('template.parent')

@section('title', 'page de saisi de note')

@section('content')
<h1>page pour inserer de nouvelle note </h1>
<form class="forms-sample" action="{{route('insertionn.saisinote')}}" method="get">
                @error("error")
                      {{$message}}
                    @enderror

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Select</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" id="matiere" name="matiere">
                    <option selected>liste des matieres</option>
                    
                      @foreach($matieres as $matiere)                                      
                        <option value="{{ $matiere->idmatiere}}">{{ $matiere->codematiere}}</option>
                      @endforeach
                    </select>
                    
                  </div>
                </div>
                
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
                    <label for="marque">note :</label>
                    <input type="number" id="note" name="note" class="form-control" required>
                </div>
                
              <button type="submit" class="btn btn-primary me-2">Valider</button>
            </form>

            

@endsection