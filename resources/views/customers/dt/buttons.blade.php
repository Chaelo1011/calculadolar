<div class="row">
    <div class="col-sm-4 col-lg-3">
        <button type="button" class="btn button-green show" style="padding: 6px 10px;" value="{{$id}}" data-toggle="modal" data-target="#modalShowCustomer"><i class="fas fa-eye"></i></button>
    </div>
    <div class="col-sm-4 col-lg-3">
        <button type="button" class="btn btn-primary edit" value="{{$id}}"><i class="fas fa-pencil"></i></button>
    </div>
    <div class="col-sm-4 col-lg-3">
        <form class="form-delete" action="{{ route('customers.delete', $id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{$id}}">
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
        </form>
    </div>
</div>