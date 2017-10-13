@if(session('notification'))
    <div class="alert alert-{{Session::get('notification.type')}} {{Session::get('notification.class')}}">
        <span>{{ session('notification.message') }}</span>
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
@endif


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif