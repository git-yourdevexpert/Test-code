{!! Form::model($user,array('method' => ($type=='edit')?'patch':'post','route' => array('users.update',['user'=>$user->id]),"id"=>"user_update_form")) !!}


<div class="form-group">
    <div class="row">
        <div class="col-12" style="background-color:#122442; color: #fff; padding:8px">
            <strong>
                Contact Information
            </strong>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-3">
            {{ Form::label('uid', 'User ID') }}
        </div>
        <div class="col-6">
            {{ Form::text('uid',$user->id,['class' => 'form-control form-control-user','disabled']) }}
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-3">
            {{ Form::label('email', 'Email Address') }}
        </div>
        <div class="col-6">
            {{ Form::email('email',NULL,['class' => 'form-control form-control-user']) }}
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-3">
            {{ Form::label('first', 'User Name') }}
        </div>
        <div class="col-6">
            {{ Form::text('username',NULL,['class' => 'form-control form-control-user']) }}
        </div>
    </div>
</div>         
<hr>
<div class="form-group">
    {!! Form::submit('Update',['class' => 'btn btn-success btn-md']);!!}
    </div>
{!! Form::close() !!}

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\UserRequest', '#user_update_form'); !!}
@endpush
