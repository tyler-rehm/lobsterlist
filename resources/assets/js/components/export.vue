<template>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exportContactModal">
        Export
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exportContactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Export Contacts</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">

                        <!-- File Type -->
                        <div class="form-group" :class="{'has-error': form.errors.has('type')}">
                            <label class="col-md-4 control-label">Type</label>

                            <div class="col-md-6">
                                <select class="form-control" name="type" v-model="form.type">
                                    <option value="csv" selected>CSV</option>
                                    <option value="xlsx">Excel</option>
                                </select>

                                <span class="help-block" v-show="form.errors.has('type')">
                                    @{{ form.errors.get('type') }}
                                </span>
                            </div>
                        </div>

                        <!-- Update Button -->
                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-6">
                                <button type="submit" class="btn btn-primary" @click="export" :disabled="form.busy">
                                    Export
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                form: new SparkForm({
                    type: '',
                })
            };
        },
        methods: {
            export() {
                Spark.post('/api/contact/export', this.form)
                        .then(response => {
                            console.log(response);
                            window.location.href = '/storage/exports/' + response;
                            $('#exportContactModal').modal('hide')
                        });
            }
        },
        ready(){

        }
    }
</script>