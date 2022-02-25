# Routes

## Admincontroller

| @route       | name       | function  |
| ------------ | ---------- | --------- |
| /admin |  | AdminController |
| ------  | -----   | ------           |
| /insert      | admin_insert     | insert    |
| /update/{id} | admin_update     | update    |
| /delete/{id} | admin_delete     | delete    |
| /add/format  | admin_add_format | addFormat |


## FormatController

| @route  | name    | function         |
| ------- | ------- | ---------------- |
| /format |  | FormatController |
| ------  | -----   | ------           |
| /       | format_home    | index            |
| /add    | format_add_format  | addFormat        |

## HomeController

| @route           | name     | function     |
| ---------------- | -------- | ------------ |
| /home            | home     | index        |
| /search/{search} | search_  | search       |
| /search/id/{id}  | searchid | getMovieById |
| /add/{id}        | addid    | addMovie     |

## MovieController

| @route                | name       | function        |
| --------------------- | ---------- | --------------- |
| /movie                |      | MovieController |
| ------                | -----      | ------          |
| /                     | movie_home       | index           |
| /search               | movie_search     | search          |
| /search/id/{id}       | movie_getbyid    | getMovieById    |
| /search/title/{title} | movie_getbytitle | getMovieByTitle |
| /add                  | movie_movie      | addMovie        |
| /liste                | movie_liste      | liste           |
