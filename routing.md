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
| /home            |  home    | HomeController |
| ------           | -----    | ------          |


## MovieController

| @route                | name       | function        |
| --------------------- | ---------- | --------------- |
| /movie                |            | MovieController |
| ------                | -----      | ------          |
| /                     | movie_home       | index           |
| /search/{search}      |movie_searchMovie | searchMovie     |
| /search               | movie_search     | search          |
| /search/id/{id}       | movie_getbyid    | getMovieById    |
| /search/title/{title} | movie_getbytitle | getMovieByTitle |
| /add/add/{id<\d+>}    | movie_addid      | addMovie        |
| /liste                | movie_liste      | liste           |

## GenreController

| @route                | name       | function        |
| --------------------- | ---------- | --------------- |
| /genre                |            | GenreController |
| ------                | -----            | ------          |
| /                     | genre_home       | index           |
| /search/name/{name}   | genre_getbyname  | getgenreByname  |
| /add/allgenre         | genre_addAllGenre| addAllGenre     |
| /add/genre/{id}       | genre_addgenre   | addGenre        |
