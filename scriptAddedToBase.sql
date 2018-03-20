CREATE VIEW post AS SELECT d.iddoc, d.auteur, d.content FROM visagelivre._post p INNER JOIN visagelivre._document d ON p.iddoc = d.iddoc;

CREATE OR REPLACE FUNCTION update_post() RETURNS TRIGGER AS $update_post$
DECLARE
	numiddoc INTEGER;
BEGIN
	INSERT INTO visagelivre._document(content, auteur) VALUES (NEW.content, NEW.auteur) RETURNING iddoc INTO numiddoc;
	INSERT INTO visagelivre._post VALUES (numiddoc);
	RETURN NEW;	
END;
$update_post$ LANGUAGE "plpgsql";

CREATE TRIGGER tg_update_post INSTEAD OF INSERT ON post
FOR EACH ROW EXECUTE PROCEDURE update_post();


-- insert into post(content, auteur) values('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Vladimir');
-- SELECT * FROM post NATURAL JOIN visagelivre._user

SELECT commentaires(2);

-- DROP FUNCTION commentaires(integer);
CREATE OR REPLACE FUNCTION commentaires(id integer) RETURNS table(s_iddoc integer, s_ref integer) AS $commentaires$
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
	ELSE
		RAISE EXCEPTION '[Error] % not found', id;
	END IF;
END;
$commentaires$ LANGUAGE "plpgsql";


CREATE VIEW vu_comment AS SELECT c.iddoc, c.ref, d.auteur, d.content FROM visagelivre._comment c INNER JOIN visagelivre._document d ON c.iddoc = d.iddoc;

CREATE OR REPLACE FUNCTION update_comment() RETURNS TRIGGER AS $update_comment$
DECLARE
	numidcom INTEGER;
BEGIN
    	INSERT INTO visagelivre._document(content, auteur) VALUES (NEW.content, NEW.auteur) RETURNING iddoc INTO numidcom;
	INSERT INTO visagelivre._comment (iddoc, ref) VALUES (NEW.iddoc, numidcom);
	RETURN NEW;
END;
$update_comment$ LANGUAGE "plpgsql";

CREATE TRIGGER tg_update_comment INSTEAD OF INSERT ON vu_comment
FOR EACH ROW EXECUTE PROCEDURE update_comment();







