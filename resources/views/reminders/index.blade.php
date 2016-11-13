@extends('spark::layouts.app')

@section('content')
    <home :user="user" inline-template>
        <div class="container">
            <!-- Application Dashboard -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Dashboard</div>

                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                                @foreach($reminders as $reminder)
                                    <tr>
                                        <td>{{ $reminder->notes }}</td>
                                        <td>{{ date('m-d-Y', strtotime($reminder->date)) }}</td>
                                        <td>{{ date('h:i A', strtotime($reminder->time)) }}</td>
                                        <td>{{ $reminder->status->name }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </home>
@endsection

