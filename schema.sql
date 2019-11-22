CREATE DATABASE yeticave;
  DEFAULT CHARACTER SET utf8;
  DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(256) UNIQUE NOT NULL,
  code VARCHAR(256) UNIQUE NOT NULL
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(256) UNIQUE NOT NULL,
  email VARCHAR(256) UNIQUE NOT NULL,
  user_password VARCHAR(256) NOT NULL,
  creation_time  DATETIME DEFAULT NOW() NOT NULL,
  contacts VARCHAR(256)
);

CREATE TABLE lot (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(256) NOT NULL,
  description TEXT,
  image VARCHAR(256) NOT NULL,
  creation_time DATETIME DEFAULT NOW() NOT NULL,
  start_date DATETIME NOT NULL,
  end_time DATETIME NOT NULL,
  step INT NOT NULL,
  author_id INT NOT NULL,
  winner_id INT,
  category_id INT NOT NULL,
  FOREIGN KEY (author_id) REFERENCES users(id),
  FOREIGN KEY (winner_id) REFERENCES users(id),
  FOREIGN KEY (category_id) REFERENCES categories(id)
);



CREATE TABLE bet (
  id INT AUTO_INCREMENT PRIMARY KEY,
  creation_time DATETIME DEFAULT NOW() NOT NULL,
  amount INT NOT NULL,
  user_id INT NOT NULL,
  lot_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (lot_id) REFERENCES lot(id)
);




