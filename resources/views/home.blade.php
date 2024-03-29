@extends('layouts.system')

@section('content')

    <br />

    <div class="justify-content-center">
        <div class="card">
            <div class="card-header text-white bg-primary">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                You are logged in!
            </div>
        </div>
    </div>

@endsection
