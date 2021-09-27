@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="justify-content-center">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    {{_("Users")}}: {{Str::ucfirst(_(request()->get('type')))}}
                </h1>
                <div class="card">
                    <div class="card-header">
                        <h5>
                            {{ __('Search') }}
                        </h5>
                    </div>
                    <div class="card-body">
                         @include('users.forms.search',['type'=>'search'])
                    </div>
                </div>
                <hr/>
                <div class="card">
                    <div class="card-body">
                        {{$dataTable->table(['class' => 'table table-striped table-bordered dt-responsive'], false)}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
