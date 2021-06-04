# NAK interview app

This project wrote exclusively for interview question of NAK corporation.

Despite the simplicity of this project, it was tried to present an advanced enterprise workflow in it.
This project has 3 main Namespaces, including *App*, *Domain* and *Support*. The responsibility of 
these namespaces and the idea of this design are derived from [this blog series](https://stitcher.io/blog/laravel-beyond-crud-01-domain-oriented-laravel).

Development of this app was based on **TDD** approach and there is a test for every core functionality.

Facade pattern and separation of concerns (SOC) was also considered in this project and can be found on both post
and comments.

**Last word:** It is obvious that such a complex workflow is not necessary for a simple project like current app,
and all of these attempts are just for presentation. 

#### List of contents
- [Installation](#installation)
- [Main Features](#main-features)
- [Design Elements](#design-elements)
- [Demo](#demo)

## Installation
### Installing using git
1. Clone the project
```bash
git clone git@bitbucket.org:ashrafibabak/nak-interview-app.git
```
2. Enter root folder of the project and copy `.env.example` file as `.env` and define database name and database credentials(username, password)
inside `.env` file.

3. Now, you need to create your database tables by running below command in terminal or cmd.
```bash
php artisan migrate
```

4. Run the server

- You can run laravel's built-in server by running below command.
```bash
php artisan serve
```
- Or setup an external server and config it to read from the 
  public folder of the project.
  
**Notice:**
Project tests can be run by running `composer test` or`php artisan test`


## Main features

- Enterprise laravel work flow (separate Domain, App and Support) namespace 
- Showing list of posts.
- Post creation and deletion
- Comment for every with rate
- Tinymce for post body with photo and video configuration
- Slug service for post
- Media service for post
- Model frontend workflow using laravel mix

## Design elements

ERD diagram of the current project is as follows:

![erd-diagram](./database/ERD_0.0.1.jpg)

## Demo

1- Post creation form and index.

![erd-diagram](./resources/demo/demo-1.png)

2- Submitting comment.

![erd-diagram](./resources/demo/demo-2.png)

3- Adding media to tinymce.

![erd-diagram](./resources/demo/demo-3.png)


## Credits
- [Babak Ashrafi](https://github.com/babak271)