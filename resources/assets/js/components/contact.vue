<template :contact="contact" :user="user">

    <form class="form-horizontal" role="form">

        <!-- ID -->
        <div class="form-group hidden">
            <div class="col-md-6">
                <input type="text" class="form-control" name="id" v-model="form.id">
            </div>
        </div>

        <!-- Title -->
        <div class="form-group" :class="{'has-error': form.errors.has('title')}">
            <label class="col-md-4 control-label">Title</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="title" v-model="form.title" v-bind:readonly="isReadOnly">

                <span class="help-block" v-show="form.errors.has('title')">
                    {{ form.errors.get('title') }}
                </span>
            </div>
        </div>

        <!-- Name -->
        <div class="form-group" :class="{'has-error': form.errors.has('name')}">
            <label class="col-md-4 control-label">Name</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="name" v-model="form.name" v-bind:readonly="isReadOnly">

                <span class="help-block" v-show="form.errors.has('name')">
                    {{ form.errors.get('name') }}
                </span>
            </div>
        </div>

        <!-- Name -->
        <div class="form-group" :class="{'has-error': form.errors.has('phone')}">
            <label class="col-md-4 control-label">Phone</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="phone" v-model="form.phone" v-bind:readonly="isReadOnly">

                <span class="help-block" v-show="form.errors.has('phone')">
                    {{ form.errors.get('phone') }}
                </span>
            </div>
        </div>

        <!-- Email -->
        <div class="form-group" :class="{'has-error': form.errors.has('email')}">
            <label class="col-md-4 control-label">Email</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="email" v-model="form.email" v-bind:readonly="isReadOnly">

                <span class="help-block" v-show="form.errors.has('email')">
                    {{ form.errors.get('email') }}
                </span>
            </div>
        </div>

        <!-- Company -->
        <div class="form-group" :class="{'has-error': form.errors.has('company')}">
            <label class="col-md-4 control-label">Company</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="company" v-model="form.company" v-bind:readonly="isReadOnly">

                <span class="help-block" v-show="form.errors.has('company')">
                    {{ form.errors.get('company') }}
                </span>
            </div>
        </div>

        <!-- Address -->
        <div class="form-group" :class="{'has-error': form.errors.has('address1')}">
            <label class="col-md-4 control-label">Address</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="address1" v-model="form.address1" v-bind:readonly="isReadOnly">

                <span class="help-block" v-show="form.errors.has('address1')">
                    {{ form.errors.get('address1') }}
                </span>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': form.errors.has('address2')}">
            <label class="col-md-4 control-label"></label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="address2" v-model="form.address2" v-bind:readonly="isReadOnly">

                <span class="help-block" v-show="form.errors.has('address2')">
                    {{ form.errors.get('address2') }}
                </span>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': form.errors.has('city')}">
            <label class="col-md-4 control-label">City</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="city" v-model="form.city" v-bind:readonly="isReadOnly">

                <span class="help-block" v-show="form.errors.has('city')">
                    {{ form.errors.get('city') }}
                </span>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': form.errors.has('state')}">
            <label class="col-md-4 control-label">State</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="state" v-model="form.state" v-bind:readonly="isReadOnly">

                <span class="help-block" v-show="form.errors.has('state')">
                    {{ form.errors.get('state') }}
                </span>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': form.errors.has('zip')}">
            <label class="col-md-4 control-label">Zip Code</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="zip" v-model="form.zip" v-bind:readonly="isReadOnly">

                <span class="help-block" v-show="form.errors.has('zip')">
                    {{ form.errors.get('zip') }}
                </span>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': form.errors.has('notes')}">
            <label class="col-md-4 control-label">Notes</label>

            <div class="col-md-6">
                <textarea type="text" class="form-control" name="notes" v-model="form.notes" v-bind:readonly="isReadOnly"></textarea>

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
        props: ['contact','user'],
        data() {
            return {
                form: new SparkForm({
                    title: '',
                    name: '',
                    phone: '',
                    email: '',
                    company: '',
                    address1: '',
                    address2: '',
                    city: '',
                    state: '',
                    zip: '',
                    id: '',
                    notes: ''
                })
            };
        },
        methods: {
            add() {
                Spark.post('/api/contact/add', this.form)
                        .then(response => {
                            console.log(response);
                            location.reload();
                        });
            }
        },
        computed: {
            isReadOnly: function () {
                if(this.spark.state.user.id.lenght && this.spark.contact.user_id){
                    var current_user = this.spark.state.user.id;
                    var contact_owner = this.spark.contact.user_id;
                    if(current_user != contact_owner){
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        },
        ready(){
            if(this.spark.contact){
                this.form.id = this.spark.contact.id;
                this.form.name = this.spark.contact.name;
                this.form.phone = this.spark.contact.phone;
                this.form.email = this.spark.contact.email;
                this.form.company = this.spark.contact.company;
                this.form.address1 = this.spark.contact.address1;
                this.form.address2 = this.spark.contact.address2;
                this.form.city = this.spark.contact.city;
                this.form.state = this.spark.contact.state;
                this.form.zip = this.spark.contact.zip;
                this.form.title = this.spark.contact.title;
                this.form.notes = this.spark.contact.notes;
            }
        }
    }
</script>