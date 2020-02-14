@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
        <div class="flash-message">
            <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </p>
        </div>
    @endif
@endforeach
