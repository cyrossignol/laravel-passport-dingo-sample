Laravel Passport + Dingo Authentication Example
===============================================

Demonstrates configuration of a Laravel project using [Passport][passport] for
authentication with a [Dingo API][dingo], with a particular focus on [internal
requests][internal].

To actually run this sample application, we need to to set up a database and
copy the *.env* template:

    cp .env.example .env

Then, add the database information to *.env* and execute the following commands:

    composer update
    php artisan key:generate
    php artisan migrate
    php artisan passport:install

We can now register a user and pop open the browser's JavaScript console in the
developer tools to send API calls. See the [API routes file](routes/api.php)
for the endpoints and commands.

Check the files changed in the [commit history][commits] to understand how this
works.

For more information, see [this Stack Overflow question][question].

[passport]: https://laravel.com/docs/passport
[dingo]: https://github.com/dingo/api
[internal]: https://github.com/dingo/api/wiki/Internal-Requests
[commits]: https://github.com/cyrossignol/laravel-passport-dingo-sample/commits/master
[question]: https://stackoverflow.com/q/47383367/5209322
