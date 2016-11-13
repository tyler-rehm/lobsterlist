<template>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addReminderModal">
        Add Reminder
    </button>

    <!-- Modal -->
    <div class="modal fade" id="addReminderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New Reminder</h4>
                </div>
                <div class="modal-body">
                    <reminder></reminder>
                </div>
            </div>
        </div>
    </div>

</template>