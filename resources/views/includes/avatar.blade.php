@if(Auth::user()->image)
    <img src="{{ route('user.avatar',['filename'=>Auth::user()->image]) }}" class="img-fluid shadow-sm avatar" alt="Foto de {{Auth::user()->name}} en Nodrys">
@endif