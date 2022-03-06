muzmatch exercise

Environment setup instructions:
- Ensure you have these installed
  - Git
  - Docker compose
- Docker
  - Clone the repo
    - git clone https://github.com/daryoosh-falak-rafat/exercise.git
  - Ensure you are in the project root
    - cd exercise
  - Build docker containers
    - sudo docker-compose build
  - Ready containers
    - sudo docker-compose uo -d
  - Move inside the server container
    - docker exec -it exercise_php_1 bash
  - Download dependencies
    - composer up
    - lots of warnings here that I unfortunately didn't get round to solving, but it should still work fine as long as none of them are red
- Phinx
  - Create db
    - go to localhost:8080
    - login with
      - System: MySQL
      - Server: db
      - Username: root
      - Password: example
      - Click login
    - When you're in create a database called exercise (leave any options as default)
  - Migrate tables
    - vendor/bin/phinx migrate
    - Make sure you do this within the container, the same way you ran composer up

As I have explained below the endpoints are all GET requests. They are as follows:
- /user/create
- /login/email/{email}/password/{password}  (the password is their name)
- /profiles/{id}/token/{token}
- /swipe/user/{user-id}/profile/{profile-id}/preference/{preference}/token/{token}

There are some parts I didn't have time to complete. Here's what I would have done:
- General
  - Go over each endpoint and use different HTTP request methods accordingly based on what each one was doing. Unfortunately I had to bring it to a close so decided to keep them all as get requests as I had them while I was testing/developing. While it's not right, and I would not have don't it this way in another scenario, the advantage is you get to test all of it from a browser!
- The bonus part
    - A straight forward file system based solution, although I did think about trying to use S3 on AWS to make a more real-world solution
    - Ensure it all reused the earlier authentication code
    - Also, would have liked to add a simple view with template engine to be able to view the pictures alongside the user information
- Part 3, location and 'Attractiveness' algorithm
  - I didn't get a chance to look, but I assume there must be some good packages to deal with location based data. Faker provides location data so would've been nice to provide random but real data to see that working
  - I would have done something quite simple for the 'Attractiveness' algorithm. Something probably just based on the number of positive swipes for the user done through the select query. There was a temptation to take this further and use it as a way to create something that would help users that have had less success, gain better visibility

Conclusion:
- What I thought
    - More time-consuming than I expected it would be!
    - It takes me additional time to refresh my mind about some of the early steps that are required for application development due to working on a singular monolithic application for such a long time
    - Very satisfying using a different approach and solving all the little issues that pop up along the way
    - I perhaps spent too much time trying to ensure the environment was as easy as possible to set up
    - I would have liked to demonstrate how I would take on larger projects or solve architectural challenges. I hope some of that has come across with this exercise
- What I tried to show
    - A willingness to use things I haven't used before (or for a very long time)
      - I use docker every day in my current role but have never gone through a setup from scratch. While I now think I should have gone for an approach that was quicker to set up I am happy that I managed to get it set up and working even thought it threw up many issues that I managed to solve
    - How I would prefer to solve issues (if I can do it at a database level I will try)
    - How I try to ensure code is readable and self documenting
    - My consideration to the next person who might work on this code
    - What I feel is the start of a well-structured and self-contained application
- What I would have done under different circumstances
    - Separate routes into groups and then have them in separate modules
    - Gone back over it all and abstracted as much as possible while giving it all a good tidy
    - Full dependency injection and avoided using 'new' everywhere to create classes
    - Follow REST standards
    - Ensure proper response codes are returned for each request
    - Parameter checking to provide appropriate response messages if there are any errors in what is sent
    - Use an ORM or database abstraction package such as DBAL to make the DAOs cleaner
    - Use middleware to ensure all requests apart from login are authenticated
    - Use Phinx seeders to allow the API to be used straight away without needing to create users or swipes
    - Added unit and integration tests to avoid the need to manually test each endpoint
    - Implement better logging and also have a debugger like Xdebug to speed things along

Thanks for your consideration. If you have any questions about anything on something doesn't work, please let me know
