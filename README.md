# auth_docker

As for today (10.11.23) it's an unfinished project and a sandbox for myself. First of all, I decided to figure out the basic parts of the app and postpone decorative work. 
Here I'm trying to implement different kinds of user authentication using Symfony 6.3 and HWIOAuthBundle.
My application is just a primitive login form that provides password-based authentication and social authentication.
I did it (Do you remember the "12 Monkeys" movie).
In fact not so much work.
The hardest part for me was configuring HWIOAuthBundle in several .yaml files—a lack of instructions.

My app is containerized. It uses three Docker containers: Nginx, Php-fpm, and PostgreSQL. You will find Dockerfiles in the "docker" directory and Makefile with different helpful commands.

How to deploy this sandbox.
1. cd your/project/directory 
2. composer update
3. create and configure .env.local, .env.test.local files. You need to replace "!ChangeMe!" strings.
4. execute "make dc_build dc_up"
5. execute "make app_bash" to get into the container.
6. execute php bin/console doctrine:migrations:migrate

   In a browser open HTTP://127.0.0.1:888/dashboard. You will be redirected to login page. Click "Login with Google".
