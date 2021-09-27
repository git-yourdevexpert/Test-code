@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="justify-content-center">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            {{ __('Settings') }}
                        </h5>
                    </div>
                    <div class="card-body">
                       @include('settings.forms.add-edit',['type'=>'edit'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
   {!! JsValidator::formRequest('App\Http\Requests\SettingRequest', '#setting-form'); !!}
@endpush
