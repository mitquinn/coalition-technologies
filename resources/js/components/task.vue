<template>
    <div class="col-8">
        <div class="card bg-light" >
            <div class="card-header">Tasks</div>
            <div class="card-body">
                <div class="list-group">
                    <a v-for="task in tasks" class="list-group-item list-group-item-action">{{task.name}}</a>
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
    </div>
</template>

<script>
    export default {

        data: function() {
            return {
                tasks: [],
                newTaskName: ''
            }
        },

        mounted() {
            this.getTasks();
        },

        methods: {
            getTasks() {
                axios.get('/api/v1/project/1/task').then(
                    response => {
                        this.tasks = response.data.data.tasks;
                    }
                );
            },
            newTask() {
                axios.post('/api/v1/task', {'name': this.newTaskName, 'project_id': 1, 'priority': 1}).then(
                    response => {
                        this.getTasks();
                        this.newTaskName = '';
                    }
                );
            }
        },
    }
</script>

<style>

</style>
