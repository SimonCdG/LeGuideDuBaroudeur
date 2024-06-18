/* Script SQL création des tables */
CREATE TABLE users (
    userid serial PRIMARY KEY,
    schoolname text not null,
    username text not null,
    password text not null
);

CREATE TABLE articles (
    articleid serial PRIMARY KEY,
    title text not null,
    imagesname text[] not null,
    content text not null,
    author int references users(userid)
);

/* Insertion de données */
INSERT INTO users VALUES
    (DEFAULT, 'EcoleA', 'Hugo', '$2y$10$QyAyTIhgeNGD6oXsaLh42OTLRbKxC7rVLhiIDj91nGYtXW0vgFNgm');

/* Le mot de passe est hashé en PASSWORD_B_CRYPT, ici ça correspond à "Test1234*" */