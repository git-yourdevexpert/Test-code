<form>
    <div class="form-row">

        <div class="form-group col-md-2">
            <input class="form-control" name="username" placeholder="User Name" type="text" value="{{request()->get('username')}}"/>
        </div>
        <div class="form-group col-md-2">
            <input class="form-control" name="email" placeholder="Email" type="text" value="{{request()->get('email')}}"/>
        </div>
       

        <div class="form-group col-md-2">
            {{ Form::select('page_length', Config::get('constants.PAGE_LENGTH'), request()->get('page_length') ?? setting('pag'),["class"=>"form-control"])}}
        </div>
       
        <div class="form-group col-md-2">
            <button class="btn btn-primary" type="submit">
                {{__('Search')}}
            </button>
            <a class="btn btn-primary" href="{{ route('users.index',['type'=>request()->get('type')]) }}" type="reset">
                {{__('Clear')}}
            </a>
        </div>

    </div>
</form>