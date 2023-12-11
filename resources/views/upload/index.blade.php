<form action="{{route('upload')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image">
    <button type="submit">send</button>
</form>
<div style="background: #0a0a0a">
    @foreach($files as $file)
        <img width="100" height="100" style="margin: 5px 15px" src="{{\Illuminate\Support\Facades\Storage::url($file)}}" alt="{{$loop->index}}">
    @endforeach
</div>



