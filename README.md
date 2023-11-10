# auth_docker

As for today (10.11.23) it's unfinished project and it's a sandbox. Here I'm trying to implement different kind of user authentication using Symfony 6.3 and HWIOAuthBundle.
My application is just primitive login-form that provides password-based and social authentications. I did it (Do you remember 12 monkeys). In fact not so much work.
The hardest part as for me was to configure HWIOAuthBundle in several .yaml files. Lack of instructions.

My app containerized. It uses three Docker containers: for Nginx, Php-fpm and PostgreSQL. You will find Dockerfiles in the "docker" directory and Makefile with different helpfull commands.
