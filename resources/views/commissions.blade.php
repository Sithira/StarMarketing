@extends('layouts.system')

@section('content')

    <br />

    <div class="justify-content-center">
        <div class="card">
            <div class="card-header text-white bg-primary">Commissions</div>

            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>CommissionID</th>
                            <th>From User</th>
                            <th>Amount</th>
                            <th>Level</th>
                            <th>Generated on</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if($commissions->isEmpty())
                            <tr>
                               <td colspan="5">No Commissions</td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ $commission->id  }}</td>
                                <td>{{ $commission->from_user  }}</td>
                                <td>{{ $commission->amount  }}</td>
                                <td>{{ $commission->level  }}</td>
                                <td>{{ $commission->created_at->toDateString()  }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection
