<template>
    <div class="col-8">
        <div v-if="this.$root.activeProject" class="card bg-light" >
            <div class="card-header">Tasks</div>
            <div class="card-body">
                <div v-for="task in tasks" class="input-group mb-3">
                    <input type="text" class="form-control readonly" v-bind:value="task.name" readonly>
                    <div class="input-group-append">
                        <button v-on:click="deleteTask(task.id)" class="btn btn-outline-danger" type="button">Delete</button>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <form v-on:submit.prevent="newTask">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" v-model="newTaskName" placeholder="Task Name" aria-label="New Task" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" v-on:click="newTask">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div v-else class="card bg-light">
            <div class="card-header">Tasks</div>
            <div class="card-body">
                <p>Select a project to display tasks.</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['tasks', 'activeProject'],
        data: function() {
            return {
                newTaskName: ''
            }
        },
        methods: {
            newTask() {
                axios.post('/api/v1/task', {'name': this.newTaskName, 'project_id': this.activeProject, 'priority': 1}).then(
                    response => {
                        this.$root.getTasks(this.activeProject);
                        this.newTaskName = '';
                    }
                );
            },
            deleteTask(id) {
                axios.delete('/api/v1/task/'+id).then(
                    response => {
                        this.$root.getTasks(this.activeProject);
                    }
                );
            }
        },
    }
</script>

<style>
    .readonly {
        background-color: white !important;
    }

</style>
