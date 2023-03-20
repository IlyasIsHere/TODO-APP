DROP DATABASE IF EXISTS TODOApp;

CREATE DATABASE TODOApp;
USE TODOApp;

CREATE TABLE users
(
    user_id    INTEGER AUTO_INCREMENT,
    username   VARCHAR(20) UNIQUE,
    email      VARCHAR(50) UNIQUE,
    hashed_pwd CHAR(60),
    PRIMARY KEY (user_id)
);

CREATE TABLE tasks
(
    task_id          INTEGER AUTO_INCREMENT,
    task_name        VARCHAR(50) NOT NULL,
    task_description TEXT,
    due_date         DATE,
    task_status      ENUM ('in progress', 'completed'),
    PRIMARY KEY (task_id)
);

CREATE TABLE categories
(
    category_id   INTEGER AUTO_INCREMENT,
    category_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (category_id)
);

CREATE TABLE task_category
(
    task_id     INTEGER,
    category_id INTEGER,
    FOREIGN KEY (task_id) REFERENCES tasks (task_id),
    FOREIGN KEY (category_id) REFERENCES categories (category_id)
);

CREATE TABLE user_task
(
    user_id INTEGER,
    task_id INTEGER,
    FOREIGN KEY (user_id) REFERENCES users (user_id),
    FOREIGN KEY (task_id) REFERENCES tasks (task_id)
);

CREATE TABLE task_reminder (
    task_id INTEGER,
    reminder_date_time DATETIME NOT NULL,
    reminder_triggered BOOLEAN DEFAULT FALSE
);

INSERT INTO categories (category_name) VALUES 
('Personal'),
('Work'),
('Study');