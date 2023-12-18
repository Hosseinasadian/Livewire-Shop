@extends('layouts.admin.app')

@section('title','Add Template')

@section('content')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <h4 class="fw-semibold mb-8">Bootstrap-Validation</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="./index.html">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        Bootstrap-Validation
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <livewire:dynamic-form :data="$data" :structure="$structure"/>
                </div>
            </div>
        </div>
    </div>
@endsection
