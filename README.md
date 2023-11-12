# auth_docker

As for today (10.11.23) it's an unfinished project and a sandbox for myself. First of all, I decided to figure out the basic parts of the app and postpone decorative work. 
Here I'm trying to implement different kinds of user authentication using Symfony 6.3 and HWIOAuthBundle.
My application is just a primitive login form that provides password-based authentication and social authentication.
I did it (Do you remember the "12 Monkeys" movie).
In fact not so much work.
The hardest part for me was configuring HWIOAuthBundle in several .yaml files—a lack of instructions.

My app is containerized. It uses three Docker containers for each of process: Nginx, Php-fpm, and PostgreSQL.
You will find Dockerfiles in the "docker/*" directories and Makefile with a helpful command.

How to deploy this sandbox.

1. git clone...
2. cd your/project/directory 
3. composer update
4. create and configure .env.local, .env.test.local files. You need to replace "!ChangeMe!" strings.
5. execute "make dc_build dc_up"
6. execute "make app_bash" to get into the container.
7. execute php bin/console doctrine:migrations:migrate

In a browser open "http://127.0.0.1:888/dashboard". You will be redirected to the login page. Click "Login with Google".
Password-based authentication also works. To try it, first of all, register your user on page "http://127.0.0.1:888/register".
