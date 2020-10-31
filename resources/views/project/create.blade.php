<form method="POST" action="/project">
    @csrf   
    Name</br>
  <input type="text" id="name" name="name"><br>
  Description</br>
  <input type="text" id="description" name="description"><br>
  Status</br>
  <select id="status" name="status">
    <option value="started">started</option>
    <option value="finished">finished</option>
    <option value="draft ">draft </option>
    </select>
  <input type="submit" value="Submit">
</form>