create table categoria
(
    id_categoria int auto_increment
        primary key,
    nombre       varchar(100) not null
)
    engine = InnoDB;

create table estado
(
    id_estado int auto_increment
        primary key,
    nombre    varchar(25) not null
)
    engine = InnoDB;

create table facultad
(
    id_facultad int auto_increment
        primary key,
    nombre      varchar(100) not null
)
    engine = InnoDB;

create table nivel
(
    id_nivel int auto_increment
        primary key,
    nombre   varchar(25) not null
)
    engine = InnoDB;

create table personal_access_tokens
(
    id             bigint unsigned auto_increment
        primary key,
    tokenable_type varchar(255)    not null,
    tokenable_id   bigint unsigned not null,
    name           varchar(255)    not null,
    token          varchar(64)     not null,
    abilities      text            null,
    last_used_at   timestamp       null,
    created_at     timestamp       null,
    updated_at     timestamp       null,
    constraint personal_access_tokens_token_unique
        unique (token)
)
    engine = InnoDB
    collate = utf8mb4_unicode_ci;

create index personal_access_tokens_tokenable_type_tokenable_id_index
    on personal_access_tokens (tokenable_type, tokenable_id);

create table tipo_doc
(
    id_tipo_doc int auto_increment
        primary key,
    tipo_doc    varchar(10) not null,
    nombre      varchar(50) not null
)
    engine = InnoDB;

create table tipo_recurso
(
    id_tipo_recurso int auto_increment
        primary key,
    nombre          varchar(50) not null
)
    engine = InnoDB;

create table tipo_usuario
(
    id_tipo_usuario int auto_increment
        primary key,
    nombre          varchar(50) not null
)
    engine = InnoDB;

create table usuario
(
    id_usuario      int auto_increment
        primary key,
    documento       varchar(25)                        not null,
    nombre          varchar(100)                       not null,
    correo          varchar(100)                       not null,
    telefono        varchar(50)                        not null,
    password        varchar(250)                       not null,
    fecha           datetime default CURRENT_TIMESTAMP not null,
    api_token       varchar(100)                       null,
    id_tipo_usuario int                                not null,
    id_tipo_doc     int                                not null,
    id_estado       int                                not null,
    constraint usuario_api_token_uindex
        unique (api_token),
    constraint usuario_correo_uindex
        unique (correo),
    constraint usuario_estado_id_estado_fk
        foreign key (id_estado) references estado (id_estado),
    constraint usuario_tipo_doc_id_tipo_doc_fk
        foreign key (id_tipo_doc) references tipo_doc (id_tipo_doc),
    constraint usuario_tipo_usuario_id_tipo_usuario_fk
        foreign key (id_tipo_usuario) references tipo_usuario (id_tipo_usuario)
)
    engine = InnoDB;

create table curso
(
    id_curso     int auto_increment
        primary key,
    nombre       varchar(100)                       not null,
    descripcion  varchar(2000)                      null,
    fecha        datetime default CURRENT_TIMESTAMP null,
    id_facultad  int                                not null,
    id_estado    int                                not null,
    id_nivel     int                                null,
    id_usuario_p int                                not null,
    constraint curso_estado_id_estado_fk
        foreign key (id_estado) references estado (id_estado),
    constraint curso_facultad_id_facultad_fk
        foreign key (id_facultad) references facultad (id_facultad),
    constraint curso_nivel_id_nivel_fk
        foreign key (id_nivel) references nivel (id_nivel),
    constraint curso_usuario_id_usuario_fk
        foreign key (id_usuario_p) references usuario (id_usuario)
)
    engine = InnoDB;

create table clase
(
    id_clase    int auto_increment
        primary key,
    nombre      varchar(250)                       not null,
    descripcion varchar(250)                       not null,
    id_curso    int                                not null,
    fecha       datetime default CURRENT_TIMESTAMP null,
    orden       int                                null,
    constraint clase_curso_id_curso_fk
        foreign key (id_curso) references curso (id_curso)
)
    engine = InnoDB;

create table curso_categoria
(
    id_curso_categoria int auto_increment
        primary key,
    id_curso           int not null,
    id_categoria       int not null,
    constraint curso_categoria_categoria_id_categoria_fk
        foreign key (id_categoria) references categoria (id_categoria),
    constraint curso_categoria_curso_id_curso_fk
        foreign key (id_curso) references curso (id_curso)
)
    engine = InnoDB;

create table recurso
(
    id_recurso      int auto_increment
        primary key,
    nombre          varchar(500)  not null,
    ruta            varchar(5000) not null,
    id_tipo_recurso int           not null,
    id_clase        int           not null,
    constraint recurso_clase_id_clase_fk
        foreign key (id_clase) references clase (id_clase),
    constraint recurso_tipo_recurso_id_tipo_recurso_fk
        foreign key (id_tipo_recurso) references tipo_recurso (id_tipo_recurso)
)
    engine = InnoDB;

create table usuario_curso
(
    id_usuario_curso int auto_increment
        primary key,
    progreso         int default 0 not null,
    id_usuario       int           not null,
    id_curso         int           not null,
    constraint usuario_curso_curso_id_curso_fk
        foreign key (id_curso) references curso (id_curso),
    constraint usuario_curso_usuario_id_usuario_fk
        foreign key (id_usuario) references usuario (id_usuario)
)
    engine = InnoDB;

