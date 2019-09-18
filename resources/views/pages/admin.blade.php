@extends('layouts.app')

@section('content')
    @if(count($movies) > 0)
        <div class="container-fluid col-lg-10">
            <table class="table table-bordered table-light">
                    <thead>
                    <th> <h2> Movies In Database </h2> </th>
                    <th colspan="2"> <a class="btn btn-primary btn-block " href="{{route('movies.create')}}"> Create </a> </th>
                    </thead>
                    @foreach($movies as $movie)
                    <tbody>                  
                          <td> <div class="text-left"><a href="{{route('movies.show',['movie'=>$movie->id])}}"><h5>{{$movie->name}}</h5> </a></div></td>
                          <td> <div class="container-fluid"><a class="btn btn-success btn-block" href="{{route('movies.edit',['movie'=>$movie->id])}}">Edit</a></div></td>
                         <td>
                                {!! Form::open(['action'=>['MoviesController@destroy',$movie->id],'method'=>'POST']) !!}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete',['class'=>'btn btn-danger btn-block'])}}
                                {!! Form::close() !!}
                         </td>             


                         
                    </tbody>
                    @endforeach
            </table>
        </div>
    @else
    <div class="jumbotron text-center col-lg-10" style="margin: 5% auto">
            <h4>Oops, Nothing To See Here :(</h4>
            <p>Create A New show :)</p>
            <a class="btn btn-primary btn-block " href="{{route('movies.create')}}"> Create </a> 
    </div>
    @endif
@endsection