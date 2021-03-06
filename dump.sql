--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.10
-- Dumped by pg_dump version 9.5.6

-- Started on 2018-03-23 17:54:26 CET

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 16 (class 2615 OID 760577)
-- Name: visagelivre; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA visagelivre;


SET search_path = visagelivre, pg_catalog;

--
-- TOC entry 247 (class 1255 OID 763445)
-- Name: commentaires(integer); Type: FUNCTION; Schema: visagelivre; Owner: -
--

CREATE FUNCTION commentaires(id integer) RETURNS TABLE(s_iddoc integer, s_ref integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
	PERFORM iddoc FROM visagelivre._comment WHERE ref = id;
	IF FOUND THEN
		RETURN QUERY WITH RECURSIVE hiera_comm AS(
			SELECT 	visagelivre._comment.iddoc,
				visagelivre._comment.ref
			FROM visagelivre._comment WHERE ref = id
			UNION
			SELECT 	co.iddoc,
				co.ref
			FROM visagelivre._comment co INNER JOIN hiera_comm hc ON co.ref = hc.iddoc
		) SELECT * FROM hiera_comm;
	
	END IF;
END;
$$;


--
-- TOC entry 245 (class 1255 OID 763433)
-- Name: update_comment(); Type: FUNCTION; Schema: visagelivre; Owner: -
--

CREATE FUNCTION update_comment() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
DECLARE
	numidcom INTEGER;
BEGIN
    	INSERT INTO visagelivre._document(content, auteur) VALUES (NEW.content, NEW.auteur) RETURNING iddoc INTO numidcom;
	INSERT INTO visagelivre._comment (ref, iddoc) VALUES (NEW.ref, numidcom);
	RETURN NEW;
END;
$$;


--
-- TOC entry 246 (class 1255 OID 763434)
-- Name: update_post(); Type: FUNCTION; Schema: visagelivre; Owner: -
--

CREATE FUNCTION update_post() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
DECLARE
	numiddoc INTEGER;
BEGIN
	INSERT INTO visagelivre._document(content, auteur) VALUES (NEW.content, NEW.auteur) RETURNING iddoc INTO numiddoc;
	INSERT INTO visagelivre._post VALUES (numiddoc);
	RETURN NEW;	
END;
$$;


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 218 (class 1259 OID 760619)
-- Name: _document; Type: TABLE; Schema: visagelivre; Owner: -
--

CREATE TABLE _document (
    iddoc integer NOT NULL,
    content character varying(128) NOT NULL,
    create_date timestamp without time zone DEFAULT now() NOT NULL,
    auteur character varying(30) NOT NULL
);


--
-- TOC entry 219 (class 1259 OID 760631)
-- Name: _post; Type: TABLE; Schema: visagelivre; Owner: -
--

CREATE TABLE _post (
    iddoc integer NOT NULL
);


--
-- TOC entry 220 (class 1259 OID 760641)
-- Name: _comment; Type: TABLE; Schema: visagelivre; Owner: -
--

CREATE TABLE _comment (
    iddoc integer NOT NULL,
    ref integer NOT NULL
);


--
-- TOC entry 217 (class 1259 OID 760617)
-- Name: _document_iddoc_seq; Type: SEQUENCE; Schema: visagelivre; Owner: -
--

CREATE SEQUENCE _document_iddoc_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2274 (class 0 OID 0)
-- Dependencies: 217
-- Name: _document_iddoc_seq; Type: SEQUENCE OWNED BY; Schema: visagelivre; Owner: -
--

ALTER SEQUENCE _document_iddoc_seq OWNED BY _document.iddoc;


--
-- TOC entry 215 (class 1259 OID 760583)
-- Name: _friendof; Type: TABLE; Schema: visagelivre; Owner: -
--

CREATE TABLE _friendof (
    nickname character varying(30) NOT NULL,
    friend character varying(30) NOT NULL,
    birth_date date DEFAULT ('now'::text)::date,
    CONSTRAINT name_friend_chk CHECK (((nickname)::text <> (friend)::text))
);


--
-- TOC entry 216 (class 1259 OID 760599)
-- Name: _friendrequest; Type: TABLE; Schema: visagelivre; Owner: -
--

CREATE TABLE _friendrequest (
    nickname character varying(30) NOT NULL,
    target character varying(30) NOT NULL,
    request_date date DEFAULT ('now'::text)::date,
    CONSTRAINT name_target_chk CHECK (((nickname)::text <> (target)::text))
);


--
-- TOC entry 214 (class 1259 OID 760578)
-- Name: _user; Type: TABLE; Schema: visagelivre; Owner: -
--

CREATE TABLE _user (
    nickname character varying(30) NOT NULL,
    pass character varying(200) NOT NULL,
    email character varying(40) NOT NULL
);


--
-- TOC entry 223 (class 1259 OID 763435)
-- Name: post; Type: VIEW; Schema: visagelivre; Owner: -
--

CREATE VIEW post AS
 SELECT d.iddoc,
    d.auteur,
    d.content,
    d.create_date
   FROM (_post p
     JOIN _document d ON ((p.iddoc = d.iddoc)));


--
-- TOC entry 224 (class 1259 OID 763440)
-- Name: vu_comment; Type: VIEW; Schema: visagelivre; Owner: -
--

CREATE VIEW vu_comment AS
 SELECT c.iddoc,
    c.ref,
    d.auteur,
    d.content,
    d.create_date
   FROM (_comment c
     JOIN _document d ON ((c.iddoc = d.iddoc)));


--
-- TOC entry 2119 (class 2604 OID 760622)
-- Name: iddoc; Type: DEFAULT; Schema: visagelivre; Owner: -
--

ALTER TABLE ONLY _document ALTER COLUMN iddoc SET DEFAULT nextval('_document_iddoc_seq'::regclass);


--
-- TOC entry 2269 (class 0 OID 760641)
-- Dependencies: 220
-- Data for Name: _comment; Type: TABLE DATA; Schema: visagelivre; Owner: -
--

INSERT INTO _comment (iddoc, ref) VALUES (8, 5);
INSERT INTO _comment (iddoc, ref) VALUES (9, 5);
INSERT INTO _comment (iddoc, ref) VALUES (10, 5);
INSERT INTO _comment (iddoc, ref) VALUES (11, 5);
INSERT INTO _comment (iddoc, ref) VALUES (12, 5);
INSERT INTO _comment (iddoc, ref) VALUES (13, 5);


--
-- TOC entry 2267 (class 0 OID 760619)
-- Dependencies: 218
-- Data for Name: _document; Type: TABLE DATA; Schema: visagelivre; Owner: -
--

INSERT INTO _document (iddoc, content, create_date, auteur) VALUES (2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '2018-03-19 16:50:57.77827', 'Vladimir');
INSERT INTO _document (iddoc, content, create_date, auteur) VALUES (3, 'coucou toi', '2018-03-19 17:39:14.792172', 'Admin');
INSERT INTO _document (iddoc, content, create_date, auteur) VALUES (5, 'Coucou kéké', '2018-03-22 17:47:55.605751', 'Ludo');
INSERT INTO _document (iddoc, content, create_date, auteur) VALUES (6, 'recoucou', '2018-03-22 17:50:51.675439', 'Ludo');
INSERT INTO _document (iddoc, content, create_date, auteur) VALUES (7, '123456789 je sais compter', '2018-03-22 17:51:53.456506', 'Ludo');
INSERT INTO _document (iddoc, content, create_date, auteur) VALUES (8, 'blabla', '2018-03-22 17:56:04.996968', 'Ludo');
INSERT INTO _document (iddoc, content, create_date, auteur) VALUES (9, 'reblabla', '2018-03-22 18:21:17.023454', 'Ludo');
INSERT INTO _document (iddoc, content, create_date, auteur) VALUES (10, 'zefbhbfzeuhzrvgmoibuzrv', '2018-03-22 18:30:47.364569', 'Ludo');
INSERT INTO _document (iddoc, content, create_date, auteur) VALUES (11, 'zefbhbfzeuhzrvgmoibuzrv', '2018-03-22 18:31:09.167398', 'Ludo');
INSERT INTO _document (iddoc, content, create_date, auteur) VALUES (12, 'coucou aussi de Admin', '2018-03-22 18:32:03.126759', 'Admin');
INSERT INTO _document (iddoc, content, create_date, auteur) VALUES (13, 'coucou aussi de Admin', '2018-03-22 18:38:12.52971', 'Admin');
INSERT INTO _document (iddoc, content, create_date, auteur) VALUES (14, 'Bonjour c''est mon premier post sur ce site, j''espère que vous serez gentils avec mwaaaaaaa !!!', '2018-03-22 18:50:40.636518', 'Admin');


--
-- TOC entry 2275 (class 0 OID 0)
-- Dependencies: 217
-- Name: _document_iddoc_seq; Type: SEQUENCE SET; Schema: visagelivre; Owner: -
--

SELECT pg_catalog.setval('_document_iddoc_seq', 14, true);


--
-- TOC entry 2264 (class 0 OID 760583)
-- Dependencies: 215
-- Data for Name: _friendof; Type: TABLE DATA; Schema: visagelivre; Owner: -
--

INSERT INTO _friendof (nickname, friend, birth_date) VALUES ('Admin', 'Ludo', '2018-03-22');
INSERT INTO _friendof (nickname, friend, birth_date) VALUES ('Ludo', 'Vladimir', '2018-03-22');


--
-- TOC entry 2265 (class 0 OID 760599)
-- Dependencies: 216
-- Data for Name: _friendrequest; Type: TABLE DATA; Schema: visagelivre; Owner: -
--

INSERT INTO _friendrequest (nickname, target, request_date) VALUES ('Ludo', 'vince', '2018-03-22');
INSERT INTO _friendrequest (nickname, target, request_date) VALUES ('Admin', 'Vladimir', '2018-03-23');


--
-- TOC entry 2268 (class 0 OID 760631)
-- Dependencies: 219
-- Data for Name: _post; Type: TABLE DATA; Schema: visagelivre; Owner: -
--

INSERT INTO _post (iddoc) VALUES (2);
INSERT INTO _post (iddoc) VALUES (3);
INSERT INTO _post (iddoc) VALUES (5);
INSERT INTO _post (iddoc) VALUES (6);
INSERT INTO _post (iddoc) VALUES (7);
INSERT INTO _post (iddoc) VALUES (14);


--
-- TOC entry 2263 (class 0 OID 760578)
-- Dependencies: 214
-- Data for Name: _user; Type: TABLE DATA; Schema: visagelivre; Owner: -
--

INSERT INTO _user (nickname, pass, email) VALUES ('nicolas', '$2y$10$oWi1WuQG.MbVc40pP6ippOkZbDquUvZeVwYwuJ8xz.EQYmZgOlxG2', 'nico@gmail.com');
INSERT INTO _user (nickname, pass, email) VALUES ('Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@datsite.eu');
INSERT INTO _user (nickname, pass, email) VALUES ('vince', 'ab4f63f9ac65152575886860dde480a1', 'rzge@gmail.com');
INSERT INTO _user (nickname, pass, email) VALUES ('Vladimir', 'd701fde59d74f76803087b6632186caf', 'vlad@datsite.eu');
INSERT INTO _user (nickname, pass, email) VALUES ('Ludo', '28fdcc190153c0fd2ff538ec18fcc113', 'ludo@lietard.fr');


--
-- TOC entry 2132 (class 2606 OID 760645)
-- Name: _comment_pk; Type: CONSTRAINT; Schema: visagelivre; Owner: -
--

ALTER TABLE ONLY _comment
    ADD CONSTRAINT _comment_pk PRIMARY KEY (iddoc);


--
-- TOC entry 2128 (class 2606 OID 760625)
-- Name: _document_pk; Type: CONSTRAINT; Schema: visagelivre; Owner: -
--

ALTER TABLE ONLY _document
    ADD CONSTRAINT _document_pk PRIMARY KEY (iddoc);


--
-- TOC entry 2124 (class 2606 OID 760588)
-- Name: _friendof_pk; Type: CONSTRAINT; Schema: visagelivre; Owner: -
--

ALTER TABLE ONLY _friendof
    ADD CONSTRAINT _friendof_pk PRIMARY KEY (nickname, friend);


--
-- TOC entry 2126 (class 2606 OID 760604)
-- Name: _friendrequest_pk; Type: CONSTRAINT; Schema: visagelivre; Owner: -
--

ALTER TABLE ONLY _friendrequest
    ADD CONSTRAINT _friendrequest_pk PRIMARY KEY (nickname, target);


--
-- TOC entry 2130 (class 2606 OID 760635)
-- Name: _post_pk; Type: CONSTRAINT; Schema: visagelivre; Owner: -
--

ALTER TABLE ONLY _post
    ADD CONSTRAINT _post_pk PRIMARY KEY (iddoc);


--
-- TOC entry 2122 (class 2606 OID 760582)
-- Name: _user_pk; Type: CONSTRAINT; Schema: visagelivre; Owner: -
--

ALTER TABLE ONLY _user
    ADD CONSTRAINT _user_pk PRIMARY KEY (nickname);


--
-- TOC entry 2142 (class 2620 OID 763444)
-- Name: tg_update_comment; Type: TRIGGER; Schema: visagelivre; Owner: -
--

CREATE TRIGGER tg_update_comment INSTEAD OF INSERT ON vu_comment FOR EACH ROW EXECUTE PROCEDURE update_comment();


--
-- TOC entry 2141 (class 2620 OID 763439)
-- Name: tg_update_post; Type: TRIGGER; Schema: visagelivre; Owner: -
--

CREATE TRIGGER tg_update_post INSTEAD OF INSERT ON post FOR EACH ROW EXECUTE PROCEDURE update_post();


--
-- TOC entry 2140 (class 2606 OID 760651)
-- Name: _comment_document_fk; Type: FK CONSTRAINT; Schema: visagelivre; Owner: -
--

ALTER TABLE ONLY _comment
    ADD CONSTRAINT _comment_document_fk FOREIGN KEY (ref) REFERENCES _document(iddoc) ON DELETE CASCADE;


--
-- TOC entry 2139 (class 2606 OID 760646)
-- Name: _comment_is_document_fk; Type: FK CONSTRAINT; Schema: visagelivre; Owner: -
--

ALTER TABLE ONLY _comment
    ADD CONSTRAINT _comment_is_document_fk FOREIGN KEY (iddoc) REFERENCES _document(iddoc) ON DELETE CASCADE;


--
-- TOC entry 2137 (class 2606 OID 760626)
-- Name: _document_user_fk; Type: FK CONSTRAINT; Schema: visagelivre; Owner: -
--

ALTER TABLE ONLY _document
    ADD CONSTRAINT _document_user_fk FOREIGN KEY (auteur) REFERENCES _user(nickname) ON DELETE CASCADE;


--
-- TOC entry 2133 (class 2606 OID 760589)
-- Name: _friendof_user_fk1; Type: FK CONSTRAINT; Schema: visagelivre; Owner: -
--

ALTER TABLE ONLY _friendof
    ADD CONSTRAINT _friendof_user_fk1 FOREIGN KEY (nickname) REFERENCES _user(nickname);


--
-- TOC entry 2134 (class 2606 OID 760594)
-- Name: _friendof_user_fk2; Type: FK CONSTRAINT; Schema: visagelivre; Owner: -
--

ALTER TABLE ONLY _friendof
    ADD CONSTRAINT _friendof_user_fk2 FOREIGN KEY (friend) REFERENCES _user(nickname);


--
-- TOC entry 2135 (class 2606 OID 760605)
-- Name: _friendrequest_user_fk1; Type: FK CONSTRAINT; Schema: visagelivre; Owner: -
--

ALTER TABLE ONLY _friendrequest
    ADD CONSTRAINT _friendrequest_user_fk1 FOREIGN KEY (nickname) REFERENCES _user(nickname);


--
-- TOC entry 2136 (class 2606 OID 760610)
-- Name: _friendrequest_user_fk2; Type: FK CONSTRAINT; Schema: visagelivre; Owner: -
--

ALTER TABLE ONLY _friendrequest
    ADD CONSTRAINT _friendrequest_user_fk2 FOREIGN KEY (target) REFERENCES _user(nickname);


--
-- TOC entry 2138 (class 2606 OID 760636)
-- Name: _post_is_document_fk; Type: FK CONSTRAINT; Schema: visagelivre; Owner: -
--

ALTER TABLE ONLY _post
    ADD CONSTRAINT _post_is_document_fk FOREIGN KEY (iddoc) REFERENCES _document(iddoc) ON DELETE CASCADE;


-- Completed on 2018-03-23 17:54:26 CET

--
-- PostgreSQL database dump complete
--

