<template>

    <div class="navbar-form navbar-left search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search" v-model="form.term" id="search_box">
        </div>
        <button class="btn btn-default" v-bind:href="search" id="search_button">Submit</button>
    </div>

</template>

<style>
    .search{
        padding-top:10px;
    }
</style>

<script>
    export default {
        data() {
            return {
                form: new SparkForm({
                    term: '',
                })
            };
        },
        computed: {
            search: function () {
                return '/contact/search/' + this.form.term;
            }
        },
        ready(){
            $('#search_box').keypress(function (e) {
                var key = e.which;
                if(key == 13)  // the enter key code
                {
                    window.open($("#search_button").attr('href'),'_self');
                }
            });
        }
    }
</script>