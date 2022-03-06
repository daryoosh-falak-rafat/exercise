muzmatch exercise

Environment setup instructions:
- Ensure you have installed
  - Git
  - Docker compose
- Docker
  - Clone the repo
  - Ensure you are in the project root
  - Build docker containers
  - Ready containers
  - Move inside the server container
  - Composer update
- Phinx
  - Create db
  - Migrate tables

There are some parts I didn't have time to complete. Here's what I would have done
- The bonus part
    - A straight forward file system based solution, although I did think about trying to use S3 on AWS to make a more real-world solution
    - Ensure it all reused the earlier authentication code
    - Also, would have liked to add a simple view with template engine to be able to view the pictures alongside the user information
- Part 3, location and 'Attractiveness' algorithm
  - I didn't get a chance to look, but I assume there must be some good packages to deal with location based data. Faker provides location data so would've been nice to provide random but real data to see that working
  - I would have done something quite simple for the 'Attractiveness' algorithm. Something probably just based on the number of positive swipes for the user done through the select query. There was a temptation to take this further and use it as a way to create something that would help users that have had less success, gain better visibility

Conclusion
- What I thought
    - More time-consuming than I thought it would be
    - It takes me additional time to refresh my mind about some of the early steps that are required for application development due to working on a singular monolithic application for such a long time
    - Very satisfying
    - I perhaps spent too much time trying to ensure the environment was as easy as possible to set up
- What I tried to show
    - A willingness to use things I haven't used before (or for a very long time)
      - I use docker every day in my current role but have never gone through a setup from scratch. While I now think I should have gone for an approach that was quicker to set up I am happy that I managed to get it set up and working even thought it threw up many issues that I managed to solve
    - How I would prefer to solve issues (if I can do it at a database level I will try)
    - How I try to ensure code is readable and self documenting
    - What I feel is the start of a well-structured and self-contained application
- What I would have done under different circumstances
    - Separate routes into groups and then have them in separate modules
    - Full dependency injection
    - Follow REST standards
    - Use an ORM or database abstraction package such as DBAL to make the DAOs cleaner
    - Use middleware to ensure all requests apart from login are authenticated
    - Use Phinx seeders to allow the API to be used straight away without needing to create users or swipes
    - Added unit and integration tests to avoid the need to manually test each endpoint
    -  Implement better logging and also have a debugger like Xdebug to speed things along