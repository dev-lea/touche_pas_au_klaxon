CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(100) NOT NULL,
  last_name  VARCHAR(100) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS agencies (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS trips (
  id INT AUTO_INCREMENT PRIMARY KEY,
  from_agency_id INT NOT NULL,
  to_agency_id   INT NOT NULL,
  depart_at DATETIME NOT NULL,
  arrive_at DATETIME NOT NULL,
  seats_total INT NOT NULL,
  seats_available INT NOT NULL,
  author_id INT NOT NULL,
  CONSTRAINT fk_from_agency FOREIGN KEY (from_agency_id) REFERENCES agencies(id),
  CONSTRAINT fk_to_agency   FOREIGN KEY (to_agency_id)   REFERENCES agencies(id),
  CONSTRAINT fk_author      FOREIGN KEY (author_id)      REFERENCES users(id)
);
