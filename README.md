Web Portal Requirements:
1. Registration for &quot;Job Seeker&quot;
Fields: Name, Email, Phone, Experience (in Years), Notice Period (in Days), Skills, Job Location (Select), Resume, Photo
Note: Validation to be implemented
2. Job Seeker Login
3. Admin Login

Admin Dashboard:
1. &quot;Job Seeker&quot; - List
Filter Option: Name, Email, Minimum Experience, Maximum Experience, Skills, Job Location
List: Name, Email, Phone, Experience, Photo, Download Resume
View: Show All Fields in Job Seeker
Actions: Delete [Use Soft Delete, Remove the Photo and Resume in Disk]

Job Seeker Dashboard:
1. Change Password:
Fields: Old Password, New Password, Confirm Password
2. Edit Profile:
Have an Edit option except Email Id.
//*****************************************
Stpes to start the application :
1. cmd-> composer install
2. create DB in .evn file // ie: job_site
3. cmd-> php artisan serve // http://localhost:8000/
4. cmd-> php artisan migrate
5. cmd-> php artisan db:seed 

Then open the site in http://localhost:8000/ 
you can do registration or login 
admin login:
admin@gmail.com
Sai@1234

user Login:
user@gmail.com
Sai@1234

Implemented:
1. Jobs for sending email notification to the registed user
2. Softdelete to delete records
3. Validations
4. Migrations
5. Seeder
6. Eloquent
7. Helper functions
8. Used Bootstrap theam for ui

Thank you
vickysoft.1990@gmail.com
