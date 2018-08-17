@extends('layouts.master')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Bewerk medewerker</h1>
    </div>
    <a class="btn btn-sm btn-primary" href="{{route('employees.index')}}">Back</a>
    <h2>{{$title}}</h2>
    <form method="post" action="{{ route('employees.update', ['id' => $employee->id]) }}" data-parsley-validate class="form-horizontal form-label-left">

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" value="{{$employee->first_name}}" id="name" name="name" class="form-control col-md-7 col-xs-12"> @if ($errors->has('first_name'))
                <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }} row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" value="{{$employee->last_name}}" id="email" name="email" class="form-control col-md-7 col-xs-12"> @if ($errors->has('last_name'))
                <span class="help-block">{{ $errors->first('last_name') }}</span>
                @endif
            </div>
        </div>


        <div class="ln_solid"></div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <input name="_method" type="hidden" value="PUT">
                <button type="submit" class="btn btn-success">Opslaan</button>
            </div>
        </div>
    </form>
</main>

@endsection