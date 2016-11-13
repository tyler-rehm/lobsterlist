<template :contact="contact">

    <form class="form-horizontal" role="form">

        <!-- ID -->
        <div class="form-group hidden">
            <div class="col-md-6">
                <input type="text" class="form-control" name="contact_id" v-model="form.contact_id" value="{{form.contact_id}}">
            </div>
        </div>

        <div class="form-group" :class="{'has-error': form.errors.has('date')}">
            <label class="col-md-4 control-label">Date</label>

            <div class="col-md-6">

                <div class='input-group'>
                    <input type="text" class="form-control" name="date" v-model="form.date" />
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>

                <span class="help-block" v-show="form.errors.has('date')">
                    {{ form.errors.get('date') }}
                </span>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': form.errors.has('time')}">
            <label class="col-md-4 control-label">Time</label>

            <div class="col-md-6">

                <div class='input-group'>
                    <input type="text" class="form-control" name="time" v-model="form.time" />
                    <span class="input-group-addon">
                        <span class="fa fa-clock-o"></span>
                    </span>
                </div>

                <span class="help-block" v-show="form.errors.has('time')">
                    {{ form.errors.get('time') }}
                </span>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': form.errors.has('notes')}">
            <label class="col-md-4 control-label">Notes</label>

            <div class="col-md-6">
                <textarea type="text" class="form-control" name="notes" v-model="form.notes"></textarea>

                <span class="help-block" v-show="form.errors.has('notes')">
                    {{ form.errors.get('notes') }}
                </span>
            </div>
        </div>

        <!-- Update Button -->
        <div class="form-group">
            <div class="col-md-offset-4 col-md-6">
                <button type="submit" class="btn btn-primary" @click="add" :disabled="form.busy">
                    Save
                </button>
            </div>
        </div>
    </form>

    <div class="alert alert-success" v-if="form.successful">
        Your contact information has been updated!
    </div>

</template>

<script>
    export default {
        props: ['contact'],
        data() {
            return {
                form: new SparkForm({
                    notes: '',
                    date: '',
                    contact_id: '',
                    time: ''
                })
            };
        },
        methods: {
            add() {
                Spark.post('/api/reminder/add', this.form)
                        .then(response => {
                            console.log(response);
                        });
            }
        },
        computed: {

        },
        ready(){
            this.form.contact_id = this.spark.contact.id;
            console.log(this.form.contact_id);
        }
    }
</script>