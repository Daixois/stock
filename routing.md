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
| /home            | home_home     | index        |
| /search/{search} | home_search_  | search       |
| /search/id/{id}  | home_searchid | getMovieById |
| /add/{id}        | home_addid    | addMovie     |

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

## GenreController

| @route                | name       | function        |
| --------------------- | ---------- | --------------- |
| /genre                |      | GenreController |
| ------                | -----      | ------          |
| /                     | genre_home       | index           |
| /search               | genre_search     | search          |
| /search/id/{id}       | genre_getbyid    | getgenreById    |
| /search/name/{name}   | genre_getbyname | getgenreByname |
| /add                  | genre_genre      | addgenre        |
| /liste                | genre_liste      | liste           |
