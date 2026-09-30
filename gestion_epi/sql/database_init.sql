
CREATE DATABASE epi;

CREATE USER 'epi'@'localhost' IDENTIFIED BY 'epi_mdp';
GRANT SELECT, INSERT, UPDATE, DELETE ON epi.* TO 'epi'@'localhost';