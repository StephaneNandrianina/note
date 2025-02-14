@extends('template.parent')

@section('title', 'relevee de note')

@section('content')
    <div class="container">
        <h1>Releve de note</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>code matiere </th>
                    <th>nom matiere </th>
                    <th>credit</th>
                    <th>note </th>
                    <th>semestre</th>
                    <th>resultat </th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($relev as $r)
                    <tr>
                        <td>{{ $r->codematiere }}</td>
                        <td>{{ $r->nommatiere }}</td>
                        <td>{{ $r->credit}}</td>
                        <td>{{ $r->notemax}}</td>
                        <td>{{ $r->idsemestre}}</td>
                        <td>{{ $r->resultat}}</td>
                        
                        <td>
                        <a href="{{route('releve.r', ['idetudiant' => $r->idetudiant, 'idsemestre' => $r->idsemestre])}}" type="button" ></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
