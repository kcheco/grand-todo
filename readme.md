# Grand ToDo

This is a standard todo application using Laravel 5.3.30

## Cloning Repo
I assuming you have composer installed on your local machine. If not please read [Laravel Installation guide](https://laravel.com/docs/5.3/installation) or go to [composer](https://getcomposer.org/). After cloning, complete the following: 

*Stay tuned. I've got you covered.*

## API Enpoints
You may use the following endpoints access the ToDo resource as well as an integration with [OpenWeatherMap's API](https://openweathermap.org/).

#### *Get all ToDos*
```
http_method: GET 
URI: http://localhost{PORT}/api/todos/

Response:
 - ToDo json for a list of exisiting ToDos. HTTP Status Code 200.
```

#### *Get a ToDo*
```
http_method: GET 
URI: http://localhost{PORT}/api/todos/{id}

Parameters: 
 - id: the ID of the ToDo

Response:
 - ToDo json for specific ToDo. HTTP Status Code 200.
```

#### *Create a ToDo*
```
http_method: POST 
URI: http://localhost{PORT}/api/todos/

Parameters: 
 - task: the name of the task you are adding to you ToDo list.
 - completed (optional): indicate whether task has been completed. Default is false.

Response:
 - ToDo json for newly created ToDo. HTTP Status Code 201.
 - Error when ToDo is not found the HTTP Status Code is 404. When parameters fail validation
 the HTTP status code is 422.
```

#### *Update a ToDo*
```
http_method: PUT/PATCH 
URI: http://localhost{PORT}/api/todos/{id}

Parameters: 
 - id: the ID of the ToDo
 - task (optional): the name of the task you are adding to you ToDo list.
 - completed (optional): indicate whether task has been completed in true or false.

Response:
 - ToDo json for updated ToDo. HTTP Status Code 202
 - Error when ToDo is not found the HTTP Status Code is 404. When parameters fail validation
 the HTTP status code is 422.
```

#### *Delete a ToDo*
```
http_method: DELETE
URI: http://localhost{PORT}/api/todos/{id}

Parameters: 
 - id: the ID of the ToDo

Response:
 - Success when ToDo has been deleted. HTTP Status Code 200.
 - Error when ToDo is not found the HTTP Status Code is 404.
```

#### *Get the Current Weather for your zipcode*
```
http_method: POST
URI: http://localhost{PORT}/api/current_weather/

Parameters: 
 - zipcode: the zipcode of location you would like to see current weather data for.

Response:
 - CurrentWeather json for specified location. HTTP Status Code 200.
 - Error when zipcode is not invalid.
```

## Request Logging
Each request is being logged. To access log data, you can call the following command on your console.
```
php artisan request_logs
```

## Testing

*Not implemented yet.*

## Miscellaneous
HTTP Status Code 418 means I AM A TEAPOT.