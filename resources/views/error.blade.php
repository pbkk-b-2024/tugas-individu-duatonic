@extends('layout.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Error') }}</div>

                    <div class="card-body">
                        <p>An error occurred. Please try again later.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">{{ __('Go to Homepage') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection