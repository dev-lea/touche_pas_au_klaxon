-- Agences
INSERT INTO agencies(name) VALUES
('Paris'),('Lyon'),('Marseille'),('Toulouse'),('Nice'),('Nantes'),
('Strasbourg'),('Montpellier'),('Bordeaux'),('Lille');

-- Users (même hash pour les deux comptes = même mot de passe "Password!23")
INSERT INTO users(first_name,last_name,phone,email,password_hash,role) VALUES
('Alexandre','Martin','0612345678','alexandre.martin@email.fr','$2y$12$iLLYPL1C8GO5l8OQekU22uncxQmrRN8e2hUow2rFSYrHHTTh05wL.','admin'),
('Sophie','Dubois','0698765432','sophie.dubois@email.fr','$2y$12$iLLYPL1C8GO5l8OQekU22uncxQmrRN8e2hUow2rFSYrHHTTh05wL.','user');

-- Trajet de test (départ J+1, arrivée J+1 + 2h)
INSERT INTO trips(from_agency_id,to_agency_id,depart_at,arrive_at,seats_total,seats_available,author_id) VALUES
(
  1, 2,
  DATE_ADD(NOW(), INTERVAL 1 DAY),
  DATE_ADD(DATE_ADD(NOW(), INTERVAL 1 DAY), INTERVAL 2 HOUR),
  3, 2, 1
);
