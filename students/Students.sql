CREATE TABLE Teacher(
                        teacherid int(11) NOT NULL AUTO_INCREMENT,
                        name varchar(55) NOT NULL DEFAULT '',
                        PRIMARY KEY (teacherid)
) ENGINE = InnoDB DEFAULT CHARSET =utf8 AUTO_INCREMENT = 5;

INSERT INTO  Teacher (teacherid, name)VALUES
                                         (1, 'Dang kim thi'),
                                         (2, 'Tran Thanh Toan'),
                                         (3, 'Nguyen Thi Vo'),
                                         (4, 'Xa Doa Nhan');

CREATE TABLE student(
                      studentId int(11) NOT NULL AUTO_INCREMENT,
                      name varchar(55) NOT NULL DEFAULT '',
                      class varchar(25) NOT NULL DEFAULT '',
                      email varchar(55) NOT NULL DEFAULT '',
                      primary key (studentId)
) ENGINE=InnoDB DEFAULT CHARSET =utf8 AUTO_INCREMENT = 19;

INSERT INTO student (studentId, name, class ,email) VALUES
    (1, 'Luong Van Minh', 'T2109M',  'Minhfpt.com'),
    (2, 'Nguyen Viet Hoang', 'T2109M',  'Hoangfpt.com'),
    (4, 'Le Van Luyen', 'T2109E',  'Luyenfpt.com'),
    (5, 'Thu Van Doan', 'T2109M', 'Doanfpt.com'),
    (6, 'Mong Van Ghet', 'T2108M',  'Ghetfpt.com'),
    (8, 'Mong Van khai', 'T2109A',  'Khaifpt.com'),
    (9, 'Nuong Van Minh', 'T2109M',  'Minhfpt.com'),
    (10, 'Tuong Van Minh', 'T2109M',  'Minhfpt.com')