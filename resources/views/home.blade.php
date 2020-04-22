@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <project v-bind:projects="projects" v-bind:active-Project="activeProject"></project>
            <task v-bind:tasks="tasks" v-bind:active-Project="activeProject"></task>
        </div>
    </div>
@endsection
