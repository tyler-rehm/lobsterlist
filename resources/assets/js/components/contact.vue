<template>

    <form class="form-horizontal" role="form">

        <!-- Name -->
        <div class="form-group" :class="{'has-error': form.errors.has('name')}">
            <label class="col-md-4 control-label">Name</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="name" v-model="form.name">

                <span class="help-block" v-show="form.errors.has('name')">
                    @{{ form.errors.get('name') }}
                </span>
            </div>
        </div>

        <!-- Name -->
        <div class="form-group" :class="{'has-error': form.errors.has('phone')}">
            <label class="col-md-4 control-label">Phone</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="phone" v-model="form.phone">

                <span class="help-block" v-show="form.errors.has('phone')">
                    @{{ form.errors.get('phone') }}
                </span>
            </div>
        </div>

        <!-- Email -->
        <div class="form-group" :class="{'has-error': form.errors.has('email')}">
            <label class="col-md-4 control-label">Email</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="email" v-model="form.email">

                <span class="help-block" v-show="form.errors.has('email')">
                    @{{ form.errors.get('email') }}
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
        data() {
            return {
                form: new SparkForm({
                    name: '',
                    phone: '',
                    email: ''
                })
            };
        },
        methods: {
            add() {
                Spark.post('/api/contact/add', this.form)
                        .then(response => {
                            console.log(response);
                            window.location.href = '/contact';
                        });
            }
        },
        ready(){

        }
    }
</script>