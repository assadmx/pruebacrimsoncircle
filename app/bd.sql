create table post(
    id_post numeric(19) not null primary key,
    title varchar(255) not null,
    content varchar(255) not null,
    author varchar(255) not null,
    slug varchar(255) not null
);
create table comment(
    id_post numeric(19) not null,
    id_comment numeric(19) not null,
    title varchar(255) not null,
    content  varchar(255) not null,
    author  varchar(255) not null,
    slug  varchar(255) not null,
    created_at datetime not null
);

ALTER TABLE comment ADD FOREIGN KEY (id_post) REFERENCES post (id_post);