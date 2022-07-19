# Phonix

The Eglo Phonix chat app, built for everyone.

# Installation

1. First unzip this project into your main directory, the one you will be hosting from.

2. Open `/resources/DB/config.php` and change these three things: `DB_SERVER, DB_USERNAME, DB_PASSWORD` to your settings for your MySQL server.

3. Once those settings are changed import the `phonix.sql` file into your MySQL server, the file is located at `/resources/DB/phonix.sql`, make sure that the database is called `phonix`.

4. Once the file is imported and MySQL is setup, go into the settings tab in PHPMyAdmin inside of the `phonix` database, click insert at the top and fill out this information:

```
id: leave blank.

smtpurl: the public url of the SMTP server you are using. (MUST BE USING SSL)

smtpport: the port of your SMTP server.

smtpusername: the username to access your SMTP server.

smtppassword: the password to access your SMTP server.

imapurl: the public url to access your IMAP server.

imapport: the port of your IMAP server.

imapusername: the username to access your IMAP server.

imappassword: the password to access your IMAP server.
```

5. After completing the above step run the Phonix server.

6. To get emails you must setup a script to run the ```/tasks/get-emails.php``` and the ```/tasks/get-spam.php``` every few minutes, we personally use UptimeRobot to ping both of those links every minute, the link should be as follows: ```https://your-server.com/tasks/get-emails.php``` and ```https://your-server.com/tasks/get-spam.php```

# What we recommend

```
For IMAP we use Courvix.com and Cloudflare to forward all emails that go to @phonix.pw to our Courvix account, we then access Courvix via their IMAP server and get the emails.

For SMTP we use Sendgrid because you can send 100 emails a day for free from their SMTP servers with your domain, their SMTP server also uses SSL.

For email handling and routing we use Cloudflare.
```

# How it works

Phonix receiving emails:

![Phonix email receive](https://user-images.githubusercontent.com/105808341/179865328-c1a7ff9a-ca98-48f6-b993-d3ee14f8724a.png)

Phonix sending emails:

![Phonix email send](https://user-images.githubusercontent.com/105808341/179865414-86350d37-20a4-4330-ae6b-21a2850f145b.png)

Phonix sending messages:

![Phonix phone send](https://user-images.githubusercontent.com/105808341/179865443-7f87fe6e-b4fc-45ea-bb7d-829d30a5b662.png)
