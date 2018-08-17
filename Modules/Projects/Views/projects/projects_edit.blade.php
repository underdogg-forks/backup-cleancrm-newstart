@extends('layouts.master')

@section('content')
<main project="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Projects</h1>
    </div>
    <a class="btn btn-sm btn-primary" href="{{route('projects.index')}}">Back</a>
    <h2>Bewerk een project</h2>
                       {!! Form::model($project, ['route' => ['projects.update', $project->id], 'method' => 'patch']) !!}

                        @include('projects.fields')

        {!! Form::close() !!}

</main>
</div>
</div>
@endsection