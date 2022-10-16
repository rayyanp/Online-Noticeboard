--- CREATED BY RAYYAN PATEL 19004507 ---
--- FINAL VERSION UPDATED AS OF 11/03/2022 ---

ADMIN: 
Username: admin
Password: banner21

admin_dashboard.php --> Admin home page after user has logged in and been verified as an admin.
edit_admin_profile.php --> Edit admins profile.
create_admin_notice.php --> Create a notice for everyone.
admin_view_notice.php --> View everyones posts/notices. Admin can sort by ASC/DESC by time created.
edit_admin_posts.php --> delete_admins_post.php or update_admins_posts.php --> View your own posts/notices and has an option to delete or update the posts/notices.
manage_posts.php --> delete_post.php or update_post.php --> View everyones posts/notices and has an option to delete or update anyones posts/notices.
manage_users.php --> delete_user.php or update_user.php --> View everyones profile and has an option to delete or update anyones profile.
stats.php --> process_form.php --> This page allows the admin to type a name of a user to check the probability of a users nationality. --> Almost works.
logout.php --> Allows the admin to logout and session is destroyed.

USER:
user_dashboard.php --> User home page after user has logged in and been verified as a user.
edit_profile.php --> Edit user profile.
create_notice.php --> Create a notice for everyone.
view_notice.php --> View everyones posts/notices. User can sort by ASC/DESC by time created.
edit_posts.php --> delete_user_post.php or update_user_post.php --> View your own posts/notices and has an option to delete or update the posts/notices.
logout.php --> Allows the user to logout and session is destroyed.

UNREGISTERED/NOT LOGGED IN:
index.php --> Webiste index/home page. Admin/User can Log in.
view_posts.php  --> View everyones posts/notices. Unregistered user can sort by ASC/DESC by time created. However the post/notice creator will be shown as anonymous.
create_posts.php --> Create a notice for everyone.
contact.php --> Contact form for any queries.
register.php  --> Create an account to become a registered user and have access to what a user has access to.

ON EVERY PAGE/REQUIRED:
header.php --> Header used on every page to display the title, time, date and user interface options.
helper.php --> The helper page is used for sanitisation and validation.
javascript.js --> javascript file for javascript and jquery functions.
footer.php --> Footer used on every page to display the creator of the Webiste and to have an organised user interface.

CSS Folder:
I have used bootstrap as well as incorporating my own cs styling.
style-dark.css - css style for standard layout and styling.
style.css - css style for dark mode.

DATABASE FILE:
noticeboard.sql --> Database for website. Unchanged for assignment/ In original form.

img Folder:
Original images provided in assignment as well as images I have added for styling.


