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
                        <div class="col-md-9">
                            <h3>Welcome to Lobster List!</h3>
                            <p>We hope you enjoy using our contact management solution.</p>
                            <br/><hr/><br/>
                            <contact_modal></contact_modal>
                            <import></import>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</home>
@endsection
