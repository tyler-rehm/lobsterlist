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
                        <contact_modal></contact_modal>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Import</div>

                    <div class="panel-body">
                        <import></import>
                    </div>
                </div>
            </div>
        </div>
    </div>
</home>
@endsection
