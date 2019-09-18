@if(count($errors) > 0)
    @foreach ($errors->all() as $error )
    <div class=" container col-lg-10 alert alert-danger">
        {{$error}}
    </div>
    @endforeach
@endif

@if(session('success'))
<div class="container col-lg-10 alert alert-success">
    {{session('success')}}
</div>
@endif

@if(session('error'))
<div class="container col-lg-10 alert alert-danger">
    {{session('error')}}
</div>
@endif