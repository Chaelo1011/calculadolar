@if(session('message'))
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        {{session('message')}}
    </div>
@endif