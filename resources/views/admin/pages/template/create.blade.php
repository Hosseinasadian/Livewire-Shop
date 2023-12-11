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
                    @if(session()->has('success'))
                        <ul class="list-group mb-4">
                            <li class="list-group-item list-group-item-success">{{session()->get('success')}}</li>
                        </ul>
                    @endif
                    <form method="post" action="{{route('admin.template.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control {{$errors->has('name')?'is-invalid':''}}" id="name" name="name"
                                           value="{{old('name')}}"
                                           placeholder="Enter Template Name"
                                           aria-describedby="submit" required/>
                                    <button class="input-group-text" type="submit" id="submit">
                                        send
                                    </button>
                                    <div class="invalid-feedback">
                                        {{($errors->has('name'))?$errors->first('name'):''}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
