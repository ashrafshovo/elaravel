@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-error">
            <button type="button" aria-hidden="true" class="close"
            onclick="this.parentElement.style.display='none'">×</button>
            <span>{{ $error }}</span>
        </div>
    @endforeach
@endif

@if (session('successMsg'))
    <div class="alert alert-success">
        <button type="button" aria-hidden="true" class="close"
        onclick="this.parentElement.style.display='none'">×</button>
        <span>{{ session('successMsg') }}</span>
    </div>
@endif