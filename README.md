# auth_docker

As for today (10.11.23) it's an unfinished project and a sandbox. Here I'm trying to implement different kinds of user authentication using Symfony 6.3 and HWIOAuthBundle.
My application is just a primitive login form that provides password-based authentication and social authentication. I did it (Do you remember the "12 Monkeys" movie). In fact not so much work.
The hardest part for me was configuring HWIOAuthBundle in several .yaml files—a lack of instructions.

My app is containerized. It uses three Docker containers: Nginx, Php-fpm, and PostgreSQL. You will find Dockerfiles in the "docker" directory and Makefile with different helpful commands.
