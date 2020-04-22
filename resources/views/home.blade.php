@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <project v-bind:projects="projects"></project>
            <task v-bind:tasks="tasks"></task>
        </div>
    </div>
@endsection
