#Routes

##Admincontroller

| @route       | name       | function  |
| ------------ | ---------- | --------- |
| /insert      | insert     | insert    |
| /update/{id} | update     | update    |
| /delete/{id} | delete     | delete    |
| /add/format  | add_format | addFormat |


##FormatController

| @route  | name    | function         |
| ------- | ------- | ---------------- |
| /format | format_ | FormatController |
| ------  | -----   | ------           |
| /       | home    | index            |
| /add    | format  | addFormat        |

##HomeController

| @route           | name     | function     |
| ---------------- | -------- | ------------ |
| /home            | home     | index        |
| /search/{search} | search_  | search       |
| /search/id/{id}  | searchid | getMovieById |
| /add/{id}        | addid    | addMovie     |

##MovieController

| @route                | name       | function        |
| --------------------- | ---------- | --------------- |
| /movie                | movie_     | MovieController |
| ------                | -----      | ------          |
| /                     | home       | index           |
| /search               | search     | search          |
| /search/id/{id}       | getbyid    | getMovieById    |
| /search/title/{title} | getbytitle | getMovieByTitle |
| /add                  | movie      | addMovie        |
| /liste                | liste      | liste           |
