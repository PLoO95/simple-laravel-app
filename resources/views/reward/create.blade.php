<form method="POST" action="/reward">
    @csrf   
  Project ID</br>
  <input type="number" id="projectId" name="projectId"><br>
  Name</br>
  <input type="text" id="name" name="name"><br>
  Description</br>
  <input type="text" id="description" name="description"><br>
  Ammout</br>
  <input type="number" id="amount" name="amount"><br>
  <input type="submit" value="Submit">
</form>