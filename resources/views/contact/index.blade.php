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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{$contact->name}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->phone}}</td>
                                        <td>
                                            <a href="/contact/view/{{$contact->id}}" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </a>
                                            <a href="/contact/delete/{{$contact->id}}" data-toggle="tooltip" title="Delete">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                            <a href="/contact/privacy/toggle/{{$contact->id}}" data-toggle="tooltip" title="Privacy">
                                                @if($contact->public)
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                @endif
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <div>
                                <contact_modal></contact_modal>
                                <export></export>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </home>
@endsection

