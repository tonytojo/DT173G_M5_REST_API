# Kursen Webbutveckling III(DT173G), Moment 5 REST-webbtjänster

## Syfte

Syftet med en REST_API är att det är platsformsoberoende.
Denna tjänst kan anropas om man vill få information om kuser som jag har läst.
Denna tjänst använder JSON format genomgående dvs alla data som man skickar in är i json och lika så returerad data är också i json. 


### Description

This file represents a REST- API and we can handle the following 4 methods
GET, POST,PUT and DELETE.
I have use Advanced Rest client to test the REST-API
Description GET method
   When we use GET we make a select from the database
   All: http://localhost:8080/DT173_Webbutveckling_3/moment5/courses
   One: http://localhost:8080/DT173_Webbutveckling_3/moment5/courses?id=x
   where x is the id I want to get

Description POST method
   When we use POST we make an insert into the database
   http://localhost:8080/DT173_Webbutveckling_3/moment5/courses
   
Description PUT method
   When we use PUT we update the database
   http://localhost:8080/DT173_Webbutveckling_3/moment5/courses?id=x
   where x is the id I want to update

Description DELETET method
   When we use DETETE we delete from the database
   http://localhost:8080/DT173_Webbutveckling_3/moment5/courses?id=x
   where x is the id I want to delete

I use two classes Database and Courses to hande the connection to the database
The database class is where I connect and close the database.
I use C-tor to connect to db in the Database class
I pass the instans of the database to the course class where I can use the existing connection.

All database communication about course is done with sql in the Course class.
The REST-API file courses.php consist of one switch statement with 4 case. Each case represents the four methods GET,DELETE,PUT and POST

I have also configure the htaccess so I can skip the extension php when I specify the rest-api address


## Installation

En installation av remote repository går till på följande sätt.

1. git clone https://github.com/tonytojo/DT173G_M5_SRV_REST_API.git  DT173G_M5_SRV
2. cd DT173G_M5_SRV

