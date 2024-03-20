# Daily Goals Project
### Requirements
1. XAMPP Control Panel for Local Environment
2. Composer
3. PHP 
4. NPM
5. Mailtrap Account

### Installation
1. Open htdocs in XAMPP folder in terminal
2. Run the following command `git clone https://github.com/jakeb-k/daily-tracker.git daily-goals`
3. Run `composer install`
4. Copy the .env.example and rename to .env (DB connection variables are preset)
5. Run migrations and seeders `php artisan migrate` `php artisan db:seed`
6. Generate the ANSI key `php artisan key:generate --ansi`
7. Run `npm install` followed by `vite build` to generate the Auth assets

Now the project should be accessible at localhost/daily-goals/public where you will be prompted to login or register
once the XAMPP Apache and MySQL are running

### Instructions
1. Register an account to test registration functionality
2. To access all the seeded entries use the following login
   email: j@j.com 
   pw: 123456
3. The user panel will appear where there are three options

### Create a goal
1. This is the custom metric that users can track and to get started click the create a goal link
2. Fill out the form
3. Once submitted it will appear in the user panel along with the 3 other seeded goals

### Do a daily log
1. Click the do a daily log link and a form will appear
2. Fill out the form, and here you can update your goal progress
3. Once the log is submitted it will appear in Recent Logs where a detailed view can be accessed
4. If progress was made on the goals this will be indicated in the goal component

### View Log History
1. Click the view log history link
2. This will show the entire log history for that specific user
3. You can view a detailed view of the log which entails whether or not goal progress was made

### Notifications
1. Setup a mailtrap account and once an inbox has created, copy the config variables from the Laravel 9+ option. 
2. Ensure to click the credentials button to view the full password and ensure it doesn't have * in it to be able to work
3. Run `php artisan schedule:run` to send an email notification to the inbox. This is currently set to every minute but in production it can be changed to be sent daily, as the server will track it. 

### Testing
1. I set up PEST testing for all my controller functions, and through Laravel Breeze package it comes with automated testing for all profile functions. Once I added the controller test functions I am able to see if everything is doing what it should be
2. To test use `vendor\bin\pest` to run the unit tests

## Acceptance Criteria
1. The Daily Goals app is built using Laravel and the powerful features it comes with such as Eloquent ORM, Blade Templating and Auto scheduling to name a few. The Daily Goals app makes full use of these features to provide a scalable and performant software. 
2. Another feature is the validation function that is apart of the controller class, which I used to control the backend functionalities. This provides a method to easily display error messages when the validation rules are not followed as well as sanitising any potential malicious scripts. 
3. I used css media queries and flexbox layouts to be able to optimise for mobile and web. By using flexbox, optimising for mobile is as simple as changing the flex-direction and widths to suit mobile use. To test mobile responsiveness I used activated the mobile view function that comes with google chrome browser. This creates an emulator that provides an accurate depiction of what the site will look like on mobile and is very helpful.
4. Migrations and seeders allow a developer to see the true potential of a web application. By also incorporating factories its possible to imitate real-life use cases without having to manually enter all the data over and over again on migration changes. I used these features to seed Goals, DailyLogs and Users which expedited the process of seeing how things could potentially work, once in use.  
5. Eloquent ORM is one of my favourite things about the Laravel framework, gone are the days of complex SQL queries that without proper configuration leave your site open to injection attacks. By defining Models and using an ERD to visualise their relationships before adding them I was able to leverage this powerful feature to create more readable and performant code. I used a bridging table to connect the progress between goals and daily logs which was incredibly useful in creating clear and coherant controller functions, as well provide a more useful application to the end user. 
6. Additional Features: 
    - Streak function: By calculating the consecutive days the user does a log, it provides them with a sense of accomplishment and a desire to keep the streak alive. 
    - jQuery Animations: Adding jQuery/JavaScript animations is a key part of creating modern websites that feel 'fun' to use. They add an important layer of reposiveness for the user to gauge and really make the site feel 'alive'. 
    - Goals: Instead of adding a custom metric, I felt like it would be much more intuitive for the user to set long term goals and use their daily logs to work towards achieving these goals. I got this idea from reading up on the John Collins work philosophy which prioritises consistent efforts, so it made sense to incorporate this into the daily logs which already track the quality and time spent each day. 
    - Daily Reminder: Another great thing about Laravel is the mailing and notification classes that come straight out of the box. By configuring a schedule function within the console it provides an intuitive feature that reminds users to continue to be consistent.
    - SMTP Mailer: I used the Mailtrap SMTP server to be able to achieve the email notifications, and simply by creating an account and an inbox you can copy the configuration straight into to the .env file and after slight changes to the mail.php file you can send and receive emails




