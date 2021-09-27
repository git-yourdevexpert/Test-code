@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="justify-content-center">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    {{_("Users")}}: {{ __('Edit') }} #{{$user->id}}
                </h1>
                <div class="card">
                    <div class="card-header">
                        <h5>
                            {{ __('Edit') }}
                        </h5>
                    </div>
                    <div class="card-body">
                         @include('users.forms.add-edit',['type'=>'edit'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
