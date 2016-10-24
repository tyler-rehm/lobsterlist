<template>
    <label type="button" class="btn btn-primary btn-lg btn-upload" :disabled="form.busy">
        <span>Import New Contact</span>

        <input v-el:photo type="file" class="form-control" name="photo" @change="update">
    </label>
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