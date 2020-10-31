# simple-laravel-app
simple-laravel-app


php artisan route:list
+--------+----------+----------------+------+------------------------------------------------------+------------+
| Domain | Method   | URI            | Name | Action                                               | Middleware |
+--------+----------+----------------+------+------------------------------------------------------+------------+
|        | GET|HEAD | /              |      | Closure                                              | web        |
|        | GET|HEAD | api/user       |      | Closure                                              | api        |
|        |          |                |      |                                                      | auth:api   |
|        | GET|HEAD | project        |      | App\Http\Controllers\ProjectController@index         | web        |
|        | POST     | project        |      | App\Http\Controllers\ProjectController@store         | web        |
|        | PUT      | project        |      | App\Http\Controllers\ProjectController@update        | web        |
|        | GET|HEAD | project/create |      | App\Http\Controllers\ProjectController@create        | web        |
|        | GET|HEAD | project/delete |      | App\Http\Controllers\ProjectController@deleteManager | web        |
|        | GET|HEAD | project/{id}   |      | App\Http\Controllers\ProjectController@show          | web        |
|        | POST     | project/{id}   |      | App\Http\Controllers\ProjectController@update        | web        |
|        | DELETE   | project/{id}   |      | App\Http\Controllers\ProjectController@delete        | web        |
|        | GET|HEAD | reward         |      | App\Http\Controllers\RewardController@index          | web        |
|        | POST     | reward         |      | App\Http\Controllers\RewardController@store          | web        |
|        | GET|HEAD | reward/create  |      | App\Http\Controllers\RewardController@create         | web        |
+--------+----------+----------------+------+------------------------------------------------------+------------+

Models:

    ApiResponse.php <--> Own model type. It is nont laravel Model extended class.
    Project.php     <--> Laravel Model extended class with parameters
    Reward.php      <--> Laravel Model extended class with parameters

View:

    -project
        -create.blade.php <--> View to create project. After use send data as POST to /project
        -delete.blade.php <--> View to delete projects. Show all available projects. After use delete button, send DELETE to /project 
    -project
        -create.blade.php <--> View to create reward. After use send data as POST to /reward

Controller

    -ProjectController.php <--> Laravel extended controler to make queries use Project(Model).
        index()         <--> Return all Project in database.
        store($respone) <--> Create Project with $respone -> name,description,status
        delete($id)     <--> Delete Project where $id is same.
        show($id)       <--> Get data about Project where $id is same.
        show($status)   <--> Get data about Project where $status is same.
        create($r)      <--> Return create view. Simple form to send post with CSRF token.
        deleteManager() <--> Return delete view. List all available project with delete button. DELETE with CRFT token request.

    -RewardController.php <--> Laravel extended controler to make queries use Reward(Model).
        index()         <--> Return all Reward in database.
        store($respone) <--> Check $respone, if is good fill parapeters send create query to database.
        create()        <--> Return create view. Simple form to send POST with CSRF token request. 
