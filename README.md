# InQuiziTeens

Heads up Quizzers! 
We, at InQuiziTeens , bring you a fresh new website to satiate all your quizzing thirsts! We have a collection of 20 handpicked questions from a mixed bag with an overall moderate difficulty level to cater to all levels of our users.  Questions are updated weekly so don’t forget to check out every week. Login with your email today and play the quiz as many times as you want with no time limit at all.  We also hash the password you enter so only you know it. (Ahem)🌚
This website has been built from scratch all by ourselves. Please use the feedback option at the end of the quiz to let us know how we can improve. 

<b>Play the quiz here 🔽<br>
https://quizing.epizy.com/index.php</b>

Wish you Happy Quzzing from all of us at InQuiziTeens.

For queries, mail to: inquiziteens@gmail.com



<h1>Moving Towards Coding</h1>

<h2>1 : Creating a MySQL Database for the project </h2> 

```sql
CREATE DATABASE quiz;
```
<h2>2 : Creating a User for the  database</h2>

```sql
    CREATE USER 'example'@localhost IDENTIFIED BY 'example';
    GRANT ALL ON workspace.* TO 'example'@localhost;
```
<h2>3: Creating All Tables</h2>

```sql
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) DEFAULT NULL,
  `pw` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `school` varchar(255) DEFAULT NULL,
  PRIMARY KEY(user_id)
);

CREATE TABLE `questions` (
  `qs_id` int(11) NOT NULL AUTO_INCREMENT,
  `qs` longtext,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `ans` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY(qs_id)
);

CREATE TABLE `score` (
  `score_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `scores` int(11) DEFAULT NULL,
  PRIMARY KEY(score_id),
  
  CONSTRAINT FOREIGN KEY(user_id)
  REFERENCES users(user_id)
  ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE `feedback` (
  `fb_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `fb` varchar(255) DEFAULT NULL,
  PRIMARY KEY(fb_id),
  
  CONSTRAINT FOREIGN KEY(user_id)
  REFERENCES users(user_id)
  ON DELETE CASCADE ON UPDATE CASCADE
);
```
<h2>4: Inserting Questions, Options and Answer </h2>

```sql
INSERT INTO `questions` (`qs`, `option1`, `option2`, `option3`, `option4`, `ans`, `image`) VALUES ('YOUR QS 1','OPTION 1','OPTION 2','OPTION3',' OPTION4 ','ANSWER','IMAGE_URL');
```

<b> In the quiz.php file , please add your first question , options and answer at the mentioned line .</b>

<h2>5: How to use GOOGLE'S SMTP EMAIL VERIFICATION feature </h2>

## Getting Started (<b> This is only applicable for websites hosted by InfinityFreeHosting</b>)

1. Download the latest version of the contact form: https://github.com/InfinityFreeHosting/contactform/releases
2. Extract the archive on your own computer.
3. Copy the `config.example.php` to `config.php` and edit the required settings.
4. Upload the extracted files to a subdirectory of your hosting account (e.g. `htdocs/contact/`).
5. Navigate to http://your-domain.epizy.com/contact/ and try out the form!

### How to get your SMTP credentials

To be able to send messages with this contact form, you'll need a working SMTP service. InfinityFree does not provide this with free hosting, but you can use third party SMTP services.

A simple, free option to use is Gmail. You can use Gmail to send your messages like so:

1. Sign up for a free Gmail account. 
2. Enable Two Factor Authentication on the Google account: https://myaccount.google.com/signinoptions/two-step-verification
3. Generate an App Specific Password for the account: https://myaccount.google.com/apppasswords
4. In the configuration file, set the SMTP Hostname `smtp.gmail.com`, enter your full Gmail address in the SMTP Username field and enter the App Specific Password in the SMTP Password field.

### How to get your reCAPTCHA credentials

To prevent spammers from being able to abuse your contact form, reCAPTCHA has been integrated by default. reCAPTCHA is a free service from Google which can prevent automated scripts from using your form.

This contact form has been integrated with reCAPTCHA v2 with the Checkbox challenge. To use this, you will need to setup your site in reCAPTCHA like so:

1. Go to the reCAPTCHA admin console: https://www.google.com/recaptcha/admin/create
2. Enter a label you can use to identify your website.
3. Choose the reCAPTCHA type "reCAPTCHA v2" and the version "Checkbox 'I'm not a robot'".
4. Under Domains, enter the domain name of your website.
5. Accept the reCAPTCHA terms and click Send.

<h2> 6: A quick overview of our file system tree </h2>
Extract the zip files  <b style="color:red;">email</b> and <b style="color:red;">vendor</b>  inside your parent directory

<div>
    <pre>
├── app.css
├── email
├── end.php
├── favicon
│   ├── android-chrome-192x192.png
│   ├── android-chrome-512x512.png
│   ├── apple-touch-icon.png
│   ├── favicon-16x16.png
│   ├── favicon-32x32.png
│   ├── favicon.ico
│   └── site.webmanifest
├── functions.php
├── images
│   ├── 21.jpg
│   ├── 2.jpg
│   └── 9.png
├── index.php
├── landingpage.php
├── loader.gif
├── logo.png
├── logout.php
├── main.js
├── otp.php
├── pdo.php
├── questionstyle.css
├── quiz1.php
├── quiz-bg.png
├── quiz.php
├── sign.php
├── style2.css
├── style.css
├── submit.php
└── vendor

 </pre>
</div>
