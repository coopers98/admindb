## AdminDB

Just a simple Laravel application to test out latest versions of Laravel, Nova, Vagrant, Homestead and PHP.

Admin/Nova panel accessed at the /nova path (such as localhost/nova)

### Entities

`Profiles` -  Tracks profile data representing a person contacted through various means of outreach

`Interactions` - An event in which a profile has been contacted by one or more means

### Setup

The standard Laravel setup steps are required.  Create a copy of the .env.example file with proper database, keys, urls and other settings.

Run `composer install`

###  API

The various `profiles` and `interactions` are API only.  Existing endpoints:

|VERB|URI|Description|Includes Available|
|----|---|-----|----|
GET | `api/profiles` | return a paginated index of `profiles` | `interactions`
GET | `api/profiles/{id}` | return a single `profile` (if it exists) | `interactions`
POST | `api/profiles` | store a new `profile`
PUT/PATCH | `api/profiles/{id}` | update an existing `profile`
DELETE | `api/profiles/{id}` | delete an existing `profile`
GET | `api/interactions` | return a paginated index of `interactions`
GET | `api/interactions/{id}` | return a single `interaction`

For the GET `api/profiles` and GET `api/profiles/{id}` endpoints, an optional URL parameter `include` may be appended
which will include nested relations when applicable (only `interactions` at this point)

e.g. `api/profiles/1?include=interactions` will cause the related `interactions` to be included with the response as a nested `interactions` object

While I manually performed this for this example, I have used https://fractal.thephpleague.com/ to build powerful
response transformations and includes in the past.

### Tests

There are a few tests included with this sample.  As we all know, building exhaustive test cases can be quite time consuming
so I only created a few as early examples.

Tests can be found in the `/tests/Unit` folder and can be run with`php artisan test`


### Disclaimer

I built this in my testing application which has some pre-existing Partners/Articles/Users on top of a Laravel Nova install
as I was testing out the new Nova and other features.
