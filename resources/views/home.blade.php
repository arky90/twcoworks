@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-info-subtle">
                <div class="card-header">{{ __('Dashboard') }} Role:  {{ Auth::user()->role }} </div>

                <div class="card-body card border border-info-subtle">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
