<template>
    <div class="col-8">
        <div v-if="this.$root.activeProject" class="card bg-light" >
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
        <div v-else>Select a project to display tasks.</div>
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
            }
        },
    }
</script>

<style>

</style>
