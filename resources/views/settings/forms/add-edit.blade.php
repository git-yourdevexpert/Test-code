{!! Form::model($setting, ['name' => 'setting-form', 'id' => 'setting-form']) !!}
   @method('PATCH')
<h4>
    {{ __('Contact Information') }}
</h4>
<div class="form-row">

    <div class="form-group col-md-3">
        <label class="col-form-label" for="business">
            {{ __('Business Name') }}
        </label>
        {!! Form::text('company',null, ['id' => 'company', 'placeholder' => __('Business name'), 'class' => "form-control "]) !!}
    </div>
    <div class="form-group col-md-3">
        <label class="col-form-label" for="email">
            {{ __('Email') }}
        </label>
         {!! Form::text('email',null, ['id' => 'email', 'placeholder' => __('Email'), 'class' => "form-control "]) !!}
    </div>
   
</div>
<div class="form-group col-md-2">
    <button class="btn btn-primary" type="submit">
        {{__('Update')}}
    </button>
</div>
{!! Form::close() !!}
