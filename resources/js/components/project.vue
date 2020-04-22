<template>
    <div class="col-4">
        <div class="card bg-light" >
            <div class="card-header">Projects</div>
            <div class="card-body">
                <div class="list-group">
                    <a
                        v-for="project in projects"
                        v-on:click="setActiveProject(project.id)"
                        v-bind:class="[project.id === activeProject ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action']"
                    >
                        {{project.name}}
                    </a>
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
        props: ['projects', 'activeProject'],
        data: function() {
            return {
                newProjectName: ''
            }
        },

        methods: {
            newProject() {
                axios.post('/api/v1/project', {'name': this.newProjectName}).then(
                    response => {
                        this.$root.getProjects();
                        this.newProjectName = '';
                        this.setActiveProject(response.data.data.id);
                    }
                );
            },
            setActiveProject(id) {
                this.$root.setActiveProject(id);
            }
        },
    }
</script>

<style>

</style>
