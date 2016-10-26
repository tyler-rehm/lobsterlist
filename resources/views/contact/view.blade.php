@extends('spark::layouts.app')

@section('content')
    <home :user="user" inline-template>
        <div class="container">
            <!-- Application Dashboard -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Contact Details</div>

                        <div class="panel-body">
                            <contact></contact>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </home>
    <script>
        window.Spark = <?php echo json_encode(array_merge(Spark::scriptVariables(), ['contact' => $contact])); ?>
    </script>
@endsection

