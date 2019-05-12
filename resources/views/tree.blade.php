@extends('layouts.system')

@section('css')
    <link href="{!! asset('css/tree.css') !!}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="mdi mdi-file-tree menu-icon"></i> My Team
                    </div>
                    <div class="card-body">
                        {!! $tree !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script src="{!! asset('js/tree.js') !!}"></script>

    <script>
        $("#user-tree")
        .treed();
    </script>

@endsection
