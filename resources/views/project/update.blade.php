<form method="POST" action="/project">
    @csrf   
    <input type="hidden" name="_method" value="PUT" />
    Id</br>
    <input type="number" id="id" name="id" value='{{ $project->id }}'><br>
    Name</br>
    <input type="text" id="name" name="name" value='{{ $project->name }}'><br>
    Status</br>
    <select id="status" name="status">
      <option value="started">started</option>
      <option value="finished">finished</option>
      <option value="draft ">draft </option>
      </select>
    <input type="submit" value="Submit">
</form>