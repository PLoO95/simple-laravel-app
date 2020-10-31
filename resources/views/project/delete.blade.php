<center>
@foreach  ($projects as $project)
<form method='POST' action="/project/ {{ $project->id }}">
    <input type="hidden" name="_method" value="DELETE" />
    @csrf   
    Name: <b>{{ $project->name }}</b></br>
  <input class="btn btn-danger" type="submit" value="Delete">
</form>
@endforeach
</center>