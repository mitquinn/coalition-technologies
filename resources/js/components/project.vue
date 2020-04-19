<template>
    <div class="col-4">
        <div class="card bg-light" >
            <div class="card-header">Projects</div>
            <div class="card-body">
                <div class="list-group">
                    <a v-for="project in projects" class="list-group-item list-group-item-action">{{project.name}}</a>
                </div>
            </div>
            <div class="card-footer">
                <form v-on:submit.prevent="newProject">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" v-model="newProjectName" placeholder="Project Name" aria-label="New Project" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" v-on:click="newProject">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data: function() {
            return {
                projects: [],
                newProjectName: ''
            }
        },

        mounted() {
            this.getProjects()
        },

        methods: {
            getProjects() {
                axios.get('/api/v1/project').then(
                    response => this.projects = response.data.data
                );
            },

            newProject() {
                axios.post('/api/v1/project', {'name': this.newProjectName}).then(
                    response => {
                        this.getProjects();
                        this.newProjectName = '';
                    }
                );
            }
        },
    }
</script>

<style>

</style>
