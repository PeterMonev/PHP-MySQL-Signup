CREATE database signup_task;

use signup_task;

CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(72) NOT NUll,
    email VARCHAR(72) NOT NULL,
    password VARCHAR(64) NOT NULL,
    phone VARCHAR(72) NOT NULL,
);