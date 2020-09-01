<div id="alert-box">
    @if(session()->has('info'))
        <div class="alert alert-info fade show" role="alert">
            {{ session()->get('info') }}
        </div>
    @elseif(session()->has('success'))
        <div class="alert alert-success fade show" role="alert">
            {{ session()->get('success') }}
        </div>
    @elseif(session()->has('danger'))
        <div class="alert alert-danger fade show" role="alert">
            {{ session()->get('danger') }}
        </div>
    @elseif(session()->has('warning'))
        <div class="alert alert-warning fade show" role="alert">
            {{ session()->get('warning') }}
        </div>
    @endif
</div>