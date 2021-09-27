<a href="{{Route('users.edit',['user'=>$id])}}{{isset($type)?$type:''}}" class="" title="{{__('Edit User')}}"><i class="fas fa-edit"></i></a>
<a href="javascript:void(0);" onclick='deleteRecord("{{Route('users.destroy',['user'=>$id])}}")'><i class="fas fa-times"></i></a>
