@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                </div>
                <div class="col-md-6 offset-md-1">
                     <a href="{{url('/admin')}}"class="btn btn-primary">Check admin</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
