
/*
 |--------------------------------------------------------------------------
 | Laravel Spark Bootstrap
 |--------------------------------------------------------------------------
 |
 | First, we will load all of the "core" dependencies for Spark which are
 | libraries such as Vue and jQuery. This also loads the Spark helpers
 | for things such as HTTP calls, forms, and form validation errors.
 |
 | Next, we'll create the root Vue application for Spark. This will start
 | the entire application and attach it to the DOM. Of course, you may
 | customize this script as you desire and load your own components.
 |
 */

require('spark-bootstrap');

require('./components/bootstrap');

import Vue from 'vue';

/*** Register Components ***/
Vue.component('project', require('./components/project.vue').default);
Vue.component('task', require('./components/task.vue').default);



let app = new Vue({
    mixins: [require('spark')],

    data: function() {
        return {
            projects: [],
            tasks: [],
            activeProject: null
        }
    },

    mounted() {
        this.getProjects();
    },

    methods: {
        getProjects() {
            axios.get('/api/v1/project').then(
                response => this.projects = response.data.data
            );
        },
        setActiveProject(id) {
            this.activeProject = id;
            this.getTasks(id);

        },
        getTasks(id) {
            axios.get('/api/v1/project/'+id).then(
                response => this.tasks = response.data.data.tasks
            );
        }
    }
});
