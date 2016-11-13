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

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Reminders</div>

                        <div class="panel-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            @foreach($reminders as $reminder)
                                <tr>
                                    <td>
                                        <p style="cursor: help;" data-toggle="tooltip" data-placement="top" title="{{ $reminder->notes }}">{{ str_limit($reminder->notes, 25) }}</p>
                                    </td>
                                    <td>
                                        {{ date('m-d-Y', strtotime($reminder->date)) }}
                                    </td>
                                    <td>
                                        {{ date('h:i A', strtotime($reminder->time)) }}
                                    </td>
                                    <td>
                                        {{ $reminder->status->name }}
                                    </td>
                                </tr>
                            @endforeach
                            </table>

                            <reminder_modal></reminder_modal>

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

