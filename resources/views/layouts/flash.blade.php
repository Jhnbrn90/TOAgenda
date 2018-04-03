@if ($flash = session('message'))
<div class="alert alert-{{ $flash[0] }}" id="flash-message" role="alert">
    {{ $flash[1] }}
</div>
@endif