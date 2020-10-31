# simple-laravel-app
simple-laravel-app

Initialize Laravel App:
1. clone repositiory to your http folder.
2. set defoult routing to public foldar
3. Copy .env.example to .env, and configurate database connection settings
4. Use command 'composer install'
5. Use command 'php artisan key:generate'
6. Use command 'php artisan migrate'
7. Start your server 

Route:

    | Method   | URI            |      | Acton
    |          |                |      |
    | GET      | project        |      | App\Http\Controllers\ProjectController@index
    | POST     | project        |      | App\Http\Controllers\ProjectController@store
    | PUT      | project        |      | App\Http\Controllers\ProjectController@update
    | GET      | project/create |      | App\Http\Controllers\ProjectController@create
    | GET      | project/delete |      | App\Http\Controllers\ProjectController@deleteManager
    | GET      | project/{id}   |      | App\Http\Controllers\ProjectController@show
    | POST     | project/{id}   |      | App\Http\Controllers\ProjectController@update
    | DELETE   | project/{id}   |      | App\Http\Controllers\ProjectController@delete
    | GET      | reward         |      | App\Http\Controllers\RewardController@index
    | POST     | reward         |      | App\Http\Controllers\RewardController@store
    | GET      | reward/create  |      | App\Http\Controllers\RewardController@create

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
        store($request) <--> Create Project with $request -> name,description,status
        delete($id)     <--> Delete Project where $id is same.
        show($id)       <--> Get data about Project where $id is same.
        show($status)   <--> Get data about Project where $status is same.
        update($request)<--> Update data when $request->id is exist in database
        create($r)      <--> Return create view. Simple form to send post with CSRF token.
        deleteManager() <--> Return delete view. List all available project with delete button. DELETE with CRFT token request.

    -RewardController.php <--> Laravel extended controler to make queries use Reward(Model).
        index()         <--> Return all Reward in database.
        store($request) <--> Check $request, if is good fill parapeters send create query to database.
        create()        <--> Return create view. Simple form to send POST with CSRF token request. 
