# Getting Started

This project is a task for interview. No dependencies , no frameworks, just native PHP.

## Installation

- after clone please add a virtual host,
- create database with name blog (by deafault) or something else if you want
- import the sql file

## Application structure

- assets - the main css js and static img files
- config - db configs, routes, and middleware shortname
- controllers - the site main controllers
- core - the core functionality, Rout parser, base Model,View,Controller, MIddleware, Session and helper trait for redirects
- middlewares - the custom middlewares
- models - the main models
- uploads - the blog post images
- views - the site view files
- .htaccess to redirect all to index.php
- index.php the autoload register and session start

## Application pages information

- The homepage "/" blog posts with infinite scroll (20 posts)
- The blog page "/blog/{id}"
- Admin login page "/admin"
- Admin dashboard "/dashboard"


## Application credentials

- The admin user login: admin@admin.com , password: admin
- The regular user you can simply register (no need to verify email)


NOTES: created in two days (i work after 20:00)
