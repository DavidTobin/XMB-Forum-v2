XMB-Forum-v2
============
Developed by David Tobin @ http://xmbforum2.com/

INSTALLATION
============

Step 1
------------

Download git at http://git-scm.com/download

Step 2
------------

Open git BASH and change directory to the location of your installation.

Example:
  cd /c/server/www/xmb/
  
Step 3
------------

Initialise a git repository by running the following command:

git init

Step 4
------------

Add this repository by running the following command.

git remote add xmb git@github.com:DavidTobin/XMB-Forum-v2

Step 5
------------

Pull the files into your local repository by running the following command:

git pull xmb master

Step 6
------------
Rename /app/config/parameters.ini.dist to /app/config/parameters.ini

Step 7
------------

Change the directory to /bin/ and install the vendors by running the commands:

cd bin
php vendors install --reinstall

Step 8
------------

Change the directory to /app and update database stuffs by running the following commands:

cd app
php console doctrine:database:create
php console doctrine:schema:update --force

Step 9
------------

Run the following query on the newly created database:

CREATE TABLE `session` (
    `session_id` varchar(255) NOT NULL,
    `session_value` text NOT NULL,
    `session_time` int(11) NOT NULL,
    PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;