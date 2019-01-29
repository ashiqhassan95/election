# Election
Computer Voting System for Educational Institutes. Developed for academical project of 2018-2019
<br>
<h4>Team members</h1>
<ul>
    <li>Ashique Hassan (Lead developer)</li>
    <li>Abdul Vadoodh (Analyst)</li>
    <li>Muhammed Shakil (Database analyst)</li>
    <li>Muhammed Mufeed </li>
    <li>Rahmathulla Khan</li>
</ul>
<br>

<h4>Prerequisities</h4>
<ul>
    <li>PHP >= 7.1.3</li>
    <li>MySQL or Postgres</li>
    <!-- <li>Nodejs</li> -->
</ul>
<br>

<h4>Installation</h4>
<ul>
    <li>Clone the repo: <strong>git clone https://github.com/ashiqhassan95/election.git</strong></li>
    <li>Change directory: Run <strong>cd election</strong></li>
    <li>Install Laravel: Run <strong>composer install</strong></li>
    <li>Install nodejs dependencies: Run <strong>npm install</strong></li>
    <li>Rename .env.example file to .env and fill the database information.</li>
    <li>Generate a new key for your local application: Run <strong>php artisan key:generate</strong></li>
    <li>Change your database settings in config/database.php</li>
    <li>Migrate your database: Run <strong>php artisan migrate</strong></li>
    <li>Seed database
        <ul>
            <li>Seed countries to database: Run <strong>php artisan db:seed --class=CountriesTableSeeder</strong></li>
        </ul>
    </li>
    <li>View application: Run <strong>php artisan serve</strong></li>
</ul>
