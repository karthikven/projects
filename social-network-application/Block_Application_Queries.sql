
/*

Queries for the following:

1. Suggest a Block for the user based on his coordinates
2. Insert userid, block id column into the Block Apply table (table that records all user-block applications)
3. Alert other users in the suggested block
4. Insert into other table once approved

*/

/* A few changes to existing tables */

CREATE TABLE user_block_neighborhood_map (
	username varchar(40) NOT NULL UNIQUE,
	block_id varchar(10) NOT NULL,
	PRIMARY KEY (username)
);

INSERT INTO user_block_neighborhood_map VALUES
('alan_tur','1117'),
("haansol",'1118'),
("ironman",'1114'),
("drogon",'1114'),
("nickfury",'1114'),
("jonsnow",'1111'),
("aryaa",'1111'),
("thor",'1114'),
("john_doe",'1111'),
("jane_doe",'1111')
;


/* Table that records all threads with their latitude and longitude */


CREATE TABLE threads (
threadid varchar(10),
username int(11),
block_id varchar(10),
content_subject varchar(50),
content varchar(200),
thread_latitude DOUBLE,
thread_longitude DOUBLE,
thread_time datetime,
upvote int(10),
PRIMARY KEY (threadid)
);


INSERT INTO threads VALUES
('1000000001','alan_tur','1117','Block Meeting #257 Discussion Topics','Hi, please reply to this thread to make a list of topics to be discussed for Block Meeting 257',-73.97,40.69,'2018-02-01 19:37:00',2),
('1000000002','alan_tur','1117','Block Meeting #257 Attendee List','Hello, please reply to this thread to record your attendance for Block Meeting #257 ',-73.97,40.69,'2018-03-01 20:37:00',3),
('1000000003','alan_tur','1117','Block Meeting #258 Discussion Topics','Hi, please reply to this thread to make a list of topics to be discussed for Block Meeting 258',-73.97,40.690,'2019-02-01 15:37:00',4),
('1000000004',"ironman",'1115','Experienced Babysitter required','Hi, we require a babysitter to look after our children on …',-73.97,40.69,'2018-06-06 10:10:00',1),
('1000000005',"ironman",'1115','Block Party on 5th January - Plan','Reply to this thread with ideas for the upcoming block party',-73.97,40.69,'2018-02-05 09:17:00',0),
('1000000006',"haansol",'1118','Reporting Carjacking','Emergency - My car on House #aaaa has been stolen',-73.92,40.645,'2018-10-05 6:10:00',3),
('1000000007',"jonsnow",'1111','Discuss increasing crime in Block ','Petty crime has been increasing in our block, we need a plan to reduce this',-73.97,40.690,'2018-01-01 10:24:00',4),
('1000000008',"drogon",'1114','Block Meeting #135 Agenda','Please reply with possible topics of discussion',-73.93,40.693,'2018-03-03 16:52:00',2),
('1000000009',"drogon",'1114','Block Meeting #136 Agenda','Hi, below is a list of topics to be discussed for Block meerting #136',-73.93,40.693,'2018-02-01 17:37:00',10),
('1000000010',"aryaa",'1111','Petition to build a Community Hall','Our block needs a Community Hall ASAP',-73.97,40.690,'2018-05-05 14:32:00',9),
('1000000011',"aryaa",'1111','Carpool Plan for the week1','Here is the pick up and drop plan for students in Brooklyn High week1',-73.97,40.690,'2018-12-12 15:15:00',1),
('1000000012',"john_doe",'1111','Carpool Plan for the week 2','Here is the pick up and drop plan for students in Brooklyn High wk2',-73.97,40.690,'2018-12-19 15:15:00',1),
('1000000013',"john_doe",'1111','Carpool Plan for the week 3','Here is the pick up and drop plan for students in Brooklyn High wk 3',-73.97,40.690,'2018-12-26 15:15:00',1),
('1000000014',"jane_doe",'1111','Carpool Plan for the week 4','Here is the pick up and drop plan for students in Brooklyn High wk 4',-73.97,40.690,'2018-12-28 15:15:00',1)
;



SELECT threadid, thread_latitude, thread_longitude, content
FROM threads
WHERE username = /*insert userid from session variable here */
ORDER BY thread_time DESC
LIMIT 3


/* --------------------------------- */

/* Queries for Block Apply */



/* 1. Suggest a Block for the user based on his coordinates */

SELECT block_id FROM address_block_neighborhood 
WHERE address_latitude = /*insert latitude entered by user */ AND address_longitude = /*insert longitude entered by user */
;


/* 2. Block Apply table */

CREATE TABLE neighborhood_social_network.user_block_apply (
	username int(11) NOT NULL UNIQUE,
	block_id varchar(10) NOT NULL,
	approval_count INT DEFAULT 0 NOT NULL,
	PRIMARY KEY (userid)
);

/* On clicking 'Apply', insert into the user_block_apply table: */

INSERT INTO neighborhood_social_network.user_block_apply (username, block_id) 
VALUES ('/*Insert username of the user who clicked apply */', '/*suggested block id from query above */')
;


/* 3. Alert other users in the suggested block */

SELECT DISTINCT username from neighborhood_social_network.user_block_neighborhood_map
WHERE block_id = '/*insert block id suggested to the user */'

/* 4. Increment approval_count when block memebers */

UPDATE neighborhood_social_network.user_block_apply SET approval_count = approval_count+1
WHERE username = '/* insert username of the user getting approved here */'
;


/* 5. Insert into other table once approved 

NOTE: Execute this after checking if approval_count is three

*/

INSERT INTO neighborhood_social_network.user_block_neighborhood_map (username, block_id)
VALUES ('/* INSERT username here*/', '/* INSERT block_id */')
;











