@extends('spark::layouts.app')

@section('css')
    <link href="/css/contact/index.css" rel="stylesheet">
@endsection

@section('content')
    <home :user="user" inline-template>
        <div class="container">
            <!-- Application Dashboard -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Dashboard</div>

                        <div class="panel-body">
                            @if(!empty($contacts[0]))
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Owner</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td>
                                            {{$contact->name}}
                                        </td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->phone}}</td>
                                        <td>
                                            <div class="owner_column">
                                            @if($contact->user_id == Auth::user()->id)
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            @endif
                                            </div>
                                        </td>
                                        <td>
                                            <a href="/contact/view/{{$contact->id}}" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </a>
                                            @if($contact->user_id == Auth::user()->id)
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
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            @else
                                <p>You don't have any contacts yet!</p>
                            @endif
                            <div>
                                <contact_modal></contact_modal>
                                <export></export>
                                <import></import>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </home>
@endsection

