/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  11/05/2017 12:15:38                      */
/*==============================================================*/


drop table if exists ALERTES;

drop table if exists DONNEE;

drop table if exists LIEU;

drop table if exists QUI;

drop table if exists SUPERVISE;

drop table if exists UTILISATEUR;

/*==============================================================*/
/* Table : ALERTES                                              */
/*==============================================================*/
create table ALERTES
(
   ID_ALERTES           int not null auto_increment,
   ID_LIEU              int not null,
   SEUIL_CRITIQUE       float,
   SEUIL_HAUT           float,
   SEUIL_BAS            float,
   TYPE_CONTACT         float,
   TYPE_DONNEE          int,
   primary key (ID_ALERTES)
);

/*==============================================================*/
/* Table : DONNEE                                               */
/*==============================================================*/
create table DONNEE
(
   ID_DONNEE            int not null auto_increment,
   ID_LIEU              int not null,
   VALEUR_DONNEE        double,
   TYPE_DONNEE          int,
   primary key (ID_DONNEE)
);

/*==============================================================*/
/* Table : LIEU                                                 */
/*==============================================================*/
create table LIEU
(
   ID_LIEU              int not null auto_increment,
   NOM_LIEU             text,
   primary key (ID_LIEU)
);

/*==============================================================*/
/* Table : QUI                                                  */
/*==============================================================*/
create table QUI
(
   ID_LIEU              int not null,
   ID_UTILISATEUR       int not null,
   primary key (ID_LIEU, ID_UTILISATEUR)
);

/*==============================================================*/
/* Table : SUPERVISE                                            */
/*==============================================================*/
create table SUPERVISE
(
   ID_UTILISATEUR       int not null,
   UTI_ID_UTILISATEUR   int not null,
   primary key (ID_UTILISATEUR, UTI_ID_UTILISATEUR)
);

/*==============================================================*/
/* Table : UTILISATEUR                                          */
/*==============================================================*/
create table UTILISATEUR
(
   ID_UTILISATEUR       int not null auto_increment,
   NOM_UTILISATEUR      text,
   TYPE_UTILISATEUR     int,
   CONTACT_MAIL         text,
   CONTACT_SMS          int,
   PASSWORD             text,
   primary key (ID_UTILISATEUR)
);

alter table ALERTES add constraint FK_ASSOCIE_A foreign key (ID_LIEU)
      references LIEU (ID_LIEU) on delete restrict on update restrict;

alter table DONNEE add constraint FK_OU foreign key (ID_LIEU)
      references LIEU (ID_LIEU) on delete restrict on update restrict;

alter table QUI add constraint FK_QUI foreign key (ID_LIEU)
      references LIEU (ID_LIEU) on delete restrict on update restrict;

alter table QUI add constraint FK_QUI2 foreign key (ID_UTILISATEUR)
      references UTILISATEUR (ID_UTILISATEUR) on delete restrict on update restrict;

alter table SUPERVISE add constraint FK_SUPERVISE foreign key (ID_UTILISATEUR)
      references UTILISATEUR (ID_UTILISATEUR) on delete restrict on update restrict;

alter table SUPERVISE add constraint FK_SUPERVISE2 foreign key (UTI_ID_UTILISATEUR)
      references UTILISATEUR (ID_UTILISATEUR) on delete restrict on update restrict;
