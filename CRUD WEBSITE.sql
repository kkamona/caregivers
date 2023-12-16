
USE caregivers;
CREATE TABLE USER (
    user_id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    given_name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    phone_number CHAR(12) NOT NULL UNIQUE,
    profile_description TEXT,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY(user_id)
);


INSERT INTO USER (email, given_name, surname, city, phone_number, profile_description, password) VALUES
 ('askar@gmail.com', 'Askar', 'Askarov', 'Astana', '+77777777723', 'With a nurturing and patient approach, I strive to make a positive impact on the lives of those I care for as a dedicated caregiver.', 'pass@word456')
,('aigerim@gmail.com', 'Aigerim', 'Abdullina', 'Shymkent', '+77777777732', 'Being a caregiver allows me to utilize my empathy and kindness to provide essential support and assistance to individuals in need.', 'securepassword')
,('sergei@mail.ru', 'Sergei', 'Sergeev', 'Aktobe', '+77777777790', 'I believe in treating every individual with respect and dignity, and I am dedicated to ensuring a safe and comfortable environment as a caregiver.', 'password!@#')
,('gulmira@mail.ru', 'Gulmira', 'Tulegenova', 'Karaganda', '+77777777701', 'As a caregiver, I am committed to providing compassionate and reliable care, striving to make a meaningful difference in the lives of those I assist.', '123password')
,('temirlan@gmail.com', 'Temirlan', 'Aubakirov', 'Taraz', '+77777777712', 'I am dedicated to providing personalized care and support, ensuring the well-being and comfort of individuals in need of caregiving services.', 'pas$word789')
,('sabina@mail.ru', 'Sabina', 'Kudaibergenova', 'Pavlodar', '+77777777721', 'With a compassionate and attentive approach, I aim to create a positive and nurturing environment for those in my care as a dedicated caregiver.', 'p@ssword101')
,('eldar@gmail.com', 'Eldar', 'Sultanov', 'Atyrau', '+77777777734', 'I take pride in providing compassionate and dependable care, striving to create a supportive and comfortable atmosphere for individuals in need of caregiving assistance.', 'password123!')
,('ainur@mail.ru', 'Ainur', 'Kenzhebayev', 'Kyzylorda', '+77777777745', 'With a patient and empathetic approach, I am committed to providing essential care and support, ensuring the well-being and happiness of those under my care.', 'pas$w0rd456')
,('madina@gmail.com', 'Madina', 'Akhmetova', 'Semey', '+77777777767', 'I am dedicated to providing reliable and compassionate care, striving to create a nurturing and supportive environment for individuals in need of caregiving assistance.', 'secure#password')
,('zhanat@gmail.com', 'Zhanat', 'Sarsembayev', 'Almaty', '+77777777756', 'Compassionate caregiver with a strong ability to provide emotional and physical support to clients. Skilled at assisting with daily activities and household tasks.', 'pass123word'),
('gaukhar@mail.ru', 'Gaukhar', 'Bekzhanova', 'Astana', '+77777777776', 'As a parent in search of reliable and caring support, I am looking for a responsible babysitter to provide attentive care for my children.', 'secure456password'),
('Bolat@gmail.com', 'Bolat', 'Bolatov', 'Shymkent', '+77777777778', 'I am looking for an empathetic and reliable caregiver to assist my elderly family member. Companionship and assistance with daily living activities are essential.', 'password!@#789'),
('zhanna@mail.ru', 'Zhanna', 'Yessenova', 'Karaganda', '+77777777777', 'In need of a playmate for my child, I am seeking someone who can engage in creative activities and foster a sense of joy and companionship for my little one.', '123pas$word'),
('mukhtar@gmail.com', 'Mukhtar', 'Kenzhebayev', 'Taraz', '+77777777789', 'Seeking a compassionate and responsible babysitter with a nurturing and patient approach to childcare. Safety and engagement are top priorities for my children.', 'pas$word789'),
('aydana@mail.ru', 'Aydana', 'Kazhimuratova', 'Pavlodar', '+77777777798', 'In need of a caregiver specializing in providing compassionate support to individuals with special needs. A nurturing and positive environment is crucial for my family member.', 'p@ssword101'),
('baurzhan@gmail.com', 'Baurzhan', 'Omarov', 'Atyrau', '+77777777728', 'Looking for an engaging playmate for my family member with special needs. Activities that promote a sense of joy and fulfillment are important for us.', 'password123!'),
('saniya@mail.ru', 'Saniya', 'Iskakova', 'Kyzylorda', '+77777777782', 'In search of an elderly caregiver who can provide compassionate and respectful assistance to my aging relative. Creating a comfortable and safe environment is a priority.', 'pas$w0rd456'),
('zere@gmail.com', 'Zere', 'Aubakirova', 'Semey', '+77777777783', 'Seeking a reliable babysitter for my children. A patient and caring approach to childcare, ensuring a safe and stimulating environment, is what we are looking for.', 'secure#password'),
('ayzhan@mail.ru', 'Ayzhan', 'Nurmagambetova', 'Aktobe', '+77777777738', 'In need of a babysitter with a creative and engaging approach to childcare. Promoting a safe and stimulating environment for my children to learn and develop is important.', 'password12345'),
('aiym@gmail.com', 'Aiym', 'Kenzhebayeva', 'Almaty', '+77777777792', 'As a family seeking dedicated care for our elderly member, we prioritize compassionate and quality care for our loved one.', 'password123');
SELECT *FROM USER;


CREATE TABLE CAREGIVER (
    caregiver_user_id INT NOT NULL,
    photo BLOB,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    caregiving_type ENUM('Babysitter', 'Elderly Caregiver', 'Playmate') NOT NULL,
    hourly_rate DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (caregiver_user_id) REFERENCES USER(user_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    PRIMARY KEY(caregiver_user_id)
);

INSERT INTO CAREGIVER (caregiver_user_id, photo, gender, caregiving_type, hourly_rate) VALUES 
	('1', LOAD_FILE('/path/to/photo2.jpg'), 'Male', 'Babysitter', 15),
    ('2', LOAD_FILE('/path/to/photo2.jpg'), 'Female', 'Elderly Caregiver', 20),
	('3', LOAD_FILE('/path/to/photo3.jpg'), 'Male', 'Playmate', 18),
    ('4', LOAD_FILE('/path/to/photo4.jpg'), 'Female', 'Babysitter', 6),
    ('5', LOAD_FILE('/path/to/photo5.jpg'), 'Male', 'Elderly Caregiver', 25),
    ('6', LOAD_FILE('/path/to/photo6.jpg'), 'Female', 'Playmate', 20),
    ('7', LOAD_FILE('/path/to/photo7.jpg'), 'Male', 'Babysitter', 7),
    ('8', LOAD_FILE('/path/to/photo8.jpg'), 'Female', 'Elderly Caregiver', 22),
    ('9', LOAD_FILE('/path/to/photo9.jpg'), 'Female', 'Playmate', 19),
    ('10', LOAD_FILE('/path/to/photo10.jpg'), 'Male', 'Babysitter', 18);
 
SELECT *FROM CAREGIVER;


CREATE TABLE MEMBER (
    member_user_id INT NOT NULL,
    house_rules TEXT,
    PRIMARY KEY (member_user_id),
    FOREIGN KEY (member_user_id) REFERENCES USER(user_id)
	ON DELETE CASCADE
    ON UPDATE CASCADE
);

INSERT INTO MEMBER (member_user_id, house_rules) VALUES 
    ('11', 'Keep the house tidy and clean.'),
    ('12', 'No shoes in the house and no pets.'),
    ('13', 'Strictly follow the meal plan.'),
    ('14', 'Quiet hours after 10 PM.'),
    ('15', 'No pets.'),
    ('16', 'Organize belongings in the living room.'),
    ('17', 'No smoking inside the house.'),
    ('18', 'Pets are not allowed inside.'),
    ('19', 'Use coasters for drinks.'),
    ('20', 'Turn off lights when not in use.');
SELECT *FROM MEMBER;



CREATE TABLE ADDRESS (
    member_user_id INT NOT NULL,
    house_number CHAR(2) NOT NULL,
    street VARCHAR(255) NOT NULL,
    town VARCHAR(255) NOT NULL,
    FOREIGN KEY (member_user_id) REFERENCES MEMBER(member_user_id)
	ON DELETE CASCADE
    ON UPDATE CASCADE,
    PRIMARY KEY(member_user_id)
);


INSERT INTO ADDRESS (member_user_id, house_number, street, town) VALUES 
    (11, '01', 'Turan Street', 'Almaty'),
    (12, '02', 'Seifullin Street', 'Astana'),
    (13, '03', 'Akzhayik Street', 'Shymkent'),
    (14, '04', 'Khan Street', 'Karaganda'),
    (15, '05', 'Konayev Street', 'Astana'),
    (16, '06', 'Mangilik El Street', 'Aktobe'),
    (17, '07', 'Zheldoksan Street', 'Kyzylorda'),
    (18, '08', 'Saryarka Street', 'Taraz'),
    (19, '09', 'Sherniyaz Street', 'Ust-Kamenogorsk'),
    (20, '10', 'Abay Batyr Street', 'Pavlodar');

SELECT *FROM ADDRESS;


CREATE TABLE JOB (
    job_id INT NOT NULL AUTO_INCREMENT,
    member_user_id INT NOT NULL,
    required_caregiving_type ENUM('Babysitter', 'Elderly Caregiver', 'Playmate') NOT NULL,
    other_requirements TEXT,
    date_posted DATE NOT NULL,
    person_age INT,
    preferred_time_intervals VARCHAR(255) NOT NULL,
    caregiving_frequency ENUM('Weekly', 'Daily', 'Weekends only') NOT NULL,
    PRIMARY KEY (job_id),
    FOREIGN KEY (member_user_id) REFERENCES MEMBER(member_user_id)
	ON DELETE CASCADE
    ON UPDATE CASCADE
);

INSERT INTO JOB (member_user_id, required_caregiving_type, other_requirements, date_posted, person_age, preferred_time_intervals, caregiving_frequency) VALUES 
    (11, 'Babysitter', 'Morning hours', '2023-09-20', 2, '9.00-11.00', 'Weekly'),
    (12, 'Elderly Caregiver', 'Evening hours', '2023-09-21', 78, '17.00-20.00', 'Daily'),
    (13, 'Playmate', 'Weekend availability and being gentle', '2023-09-22', 5, '20.00-21.00', 'Weekends only'),
    (14, 'Babysitter', 'Flexible schedule', '2023-09-23', 3, '19.00-21.00', 'Weekly'),
    (15, 'Elderly Caregiver', 'Experience with dementia patients', '2023-09-24', 89, '11.00-15.00', 'Daily'),
    (16, 'Playmate', 'Creative activities', '2023-09-25', 8, '14.00-16.00', 'Weekends Only'),
    (17, 'Babysitter', 'CPR certification required', '2023-09-26', 4, '17.00-20.00', 'Daily'),
    (18, 'Elderly Caregiver', 'Assistance with medication', '2023-09-27', 90, '9.00-11.00', 'Weekly'),
    (19, 'Playmate', 'Experience with special needs children', '2023-09-28', 6, '19.00-20.00', 'Weekends only'),
    (20, 'Babysitter', 'Gentle', '2023-09-29', 5, '16.00-18.00', 'Daily');

SELECT *FROM JOB;


CREATE TABLE JOB_APPLICATION (
    caregiver_user_id INT NOT NULL,
    job_id INT NOT NULL,
    date_applied DATE NOT NULL,
    FOREIGN KEY (caregiver_user_id) REFERENCES CAREGIVER(caregiver_user_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY (job_id) REFERENCES JOB(job_id) 
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    PRIMARY KEY (caregiver_user_id, job_id)
);


INSERT INTO JOB_APPLICATION (caregiver_user_id, job_id, date_applied) VALUES 
    (1, 4, '2023-10-20'),
    (2, 2, '2023-10-21'),
    (3, 3, '2023-10-22'),
    (4, 4, '2023-10-23'),
    (5, 5, '2023-10-24'),
    (6, 6, '2023-10-25'),
    (7, 7, '2023-10-26'),
    (8, 2, '2023-10-27'),
    (9, 9, '2023-10-28'),
    (10, 10, '2023-10-29');

SELECT *FROM JOB_APPLICATION;

CREATE TABLE APPOINTMENT (
    appointment_id INT NOT NULL AUTO_INCREMENT,
    caregiver_user_id INT NOT NULL,
    member_user_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    work_hours INT NOT NULL,
    status ENUM('Pending', 'Confirmed', 'Declined') NOT NULL,
    PRIMARY KEY (appointment_id),
    FOREIGN KEY (caregiver_user_id) REFERENCES CAREGIVER(caregiver_user_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY (member_user_id) REFERENCES MEMBER(member_user_id)
	ON DELETE CASCADE
    ON UPDATE CASCADE
);


INSERT INTO APPOINTMENT (caregiver_user_id, member_user_id, appointment_date, appointment_time, work_hours, status) VALUES 
    (1, 14, '2023-11-01', '9:00', 2, 'Confirmed'),
    (2, 12, '2023-11-02', '17:00', 3, 'Pending'),
    (3, 13, '2023-11-03', '20:00', 1, 'Confirmed'),
    (4, 14, '2023-11-04', '19:00', 2, 'Pending'),
    (5, 15, '2023-11-05', '11:00', 4, 'Confirmed'),
    (6, 16, '2023-11-06', '14:00', 2, 'Pending'),
    (7, 17, '2023-11-07', '17:00', 3, 'Confirmed'),
    (8, 12, '2023-11-08', '9:00', 2, 'Pending'),
    (9, 19, '2023-11-09', '19:00', 1, 'Confirmed'),
    (10, 20, '2023-11-10', '16:00', 2, 'Pending');

SELECT *FROM APPOINTMENT;










































