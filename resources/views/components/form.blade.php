@props([ 
    'title' => '',
    'spinner' => false,
    'method' => 'post'
])

<form {{ $attributes }} method={{ strtolower($method) == 'put' || strtolower($method) == 'patch' ? 'post' : $method }}>
    @csrf
    @method($method)

    @if($title !== '')
        <div class="modal-header">
            <h5 class="modal-title">{{ $title }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    @endif

    @if($spinner)
        <div class="modal-spinner flex w-100">
            <div class="spinner-border ms-auto me-auto mt-5 mb-5"  role="status"></div>
        </div>
    @endif
    
    {{ $slot }}
</form>