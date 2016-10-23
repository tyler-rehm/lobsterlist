<template>
    <div>
        <div class="panel-heading">Profile Photo</div>

        <div class="panel-body">
            <div class="alert alert-danger" v-if="form.errors.has('photo')">
                @{{ form.errors.get('photo') }}
            </div>

            <form class="form-horizontal" role="form">
                <!-- Photo Preview-->
                <div class="form-group">
                    <label class="col-md-4 control-label">&nbsp;</label>

                    <div class="col-md-6">
                    <span role="img" class="profile-photo-preview"
                          :style="previewStyle">
                    </span>
                    </div>
                </div>

                <!-- Update Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label">&nbsp;</label>

                    <div class="col-md-6">
                        <label type="button" class="btn btn-primary btn-upload" :disabled="form.busy">
                            <span>Select New Photo</span>

                            <input v-el:photo type="file" class="form-control" name="photo" @change="update">
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {

        /**
         * The component's data.
         */
        data() {
            return {
                form: new SparkForm({})
            };
        },


        methods: {
            /**
             * Update the user's profile photo.
             */
            update(e) {
                e.preventDefault();

                var self = this;

                this.form.startProcessing();

                // We need to gather a fresh FormData instance with the profile photo appended to
                // the data so we can POST it up to the server. This will allow us to do async
                // uploads of the profile photos. We will update the user after this action.
                $.ajax({
                    url: '/contact/import',
                    data: this.gatherFormData(),
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    headers: {
                        'X-XSRF-TOKEN': Cookies.get('XSRF-TOKEN')
                    },
                    success: function () {
                        self.form.finishProcessing();
                        window.location.href = '/contact';
                    },
                    error: function (error) {
                        self.form.setErrors(error.responseJSON);
                    }
                });
            },


            /**
             * Gather the form data for the photo upload.
             */
            gatherFormData() {
                const data = new FormData();

                data.append('photo', this.$els.photo.files[0]);

                return data;
            }
        }
    };

</script>