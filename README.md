# auth_docker

As for today (10.11.23) it's an unfinished project and a sandbox for myself. First of all, I decided to figure out the basic parts of the app and postpone decorative work. 
Here I'm trying to implement different kinds of user authentication using Symfony 6.3 and HWIOAuthBundle.
My application is just a primitive login form that provides password-based authentication and social authentication.
I did it (Do you remember the "12 Monkeys" movie).
In fact not so much work.
The hardest part for me was configuring HWIOAuthBundle in several .yaml files—a lack of instructions.

My app is containerized. It uses three Docker containers: Nginx, Php-fpm, and PostgreSQL. You will find Dockerfiles in the "docker" directory and Makefile with different helpful commands.

How to deploy this sandbox?
Actually, I'm not sure it will work when cloned. I'll solve this problem someday. 
In any case: 'composer update' and 'make dc_build dc_up'.
I think you have to create the database. 
