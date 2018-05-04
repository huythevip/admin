
@if( count($errors) > 0 )
    <div class="alert alert-danger">
        @foreach($errors as $error)
            <strong>{{ $error }}</strong>
        @endforeach
    </div>
@endif