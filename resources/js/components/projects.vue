<template>
    <div class="container">
        <div class="col-3">
            <div class="card bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">Projects</div>
                <div class="card-body">
                    <div class="list-group">
                        <a v-for="project in projects" class="list-group-item list-group-item-action">{{project.name}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data: function() {
            return {
                projects: []
            }
        },

        mounted() {
            axios.get('/api/v1/project').then(
                response => this.projects = response.data.data
            );
        },

        methods: {

        },

    }
</script>

<style>

</style>
