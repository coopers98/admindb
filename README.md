## AdminDB

Just a simple Laravel application to test out latest versions of Laravel, Nova, Vagrant, Homestead and PHP.

Admin/Nova panel accessed at the /nova path (such as localhost/nova)

### Entities

`Users` - Standard email/password users.  See the UsersTableSeeder for login credentials for various users and user levels
`Articles` - A list of Articles that are compromised of only Titles
`Partners` - A list of 'partners'.  Partners can be related to Articles in a Many to Many Relationship.  Additionally, 
Users can be related to Partners, also by a Many to Many Relationship.

### User Access Levels

In the Nova backend, there are basically 3 levels of access.

`Admins` - Currently an `admin` is set by a flag on the User entity.  Admins have full access and CRUD capabilities in the backend
to all entities.

`Partner Affiliated Users` -  A non-Admin user who is affiliated with an existing Partner.  These users will be able to see
their own Partner data, as well as the Articles that are related to any Partners that the user is affiliated with.  These
users will have the ability to view and list their related data, but will have no CRUD permissions for any entities.
 
`Non-partner, Non-admin Users` - These users will be able to login and access to the Nova panel, but will not be presented
with any content.  

