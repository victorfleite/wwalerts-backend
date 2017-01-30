--
-- PostgreSQL database dump
--

-- Dumped from database version 9.4.8
-- Dumped by pg_dump version 9.4.8
-- Started on 2017-01-30 16:57:57 BRST

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 1 (class 3079 OID 11897)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2130 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 182 (class 1259 OID 24803)
-- Name: social_account; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE social_account (
    id integer NOT NULL,
    user_id integer,
    provider character varying(255) NOT NULL,
    client_id character varying(255) NOT NULL,
    data text,
    code character varying(32) DEFAULT NULL::character varying,
    created_at integer,
    email character varying(255) DEFAULT NULL::character varying,
    username character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE social_account OWNER TO postgres;

--
-- TOC entry 181 (class 1259 OID 24801)
-- Name: account_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE account_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE account_id_seq OWNER TO postgres;

--
-- TOC entry 2131 (class 0 OID 0)
-- Dependencies: 181
-- Name: account_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE account_id_seq OWNED BY social_account.id;


--
-- TOC entry 177 (class 1259 OID 24754)
-- Name: auth_assignment; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE auth_assignment (
    item_name character varying(64) NOT NULL,
    user_id character varying(64) NOT NULL,
    created_at integer
);


ALTER TABLE auth_assignment OWNER TO postgres;

--
-- TOC entry 175 (class 1259 OID 24725)
-- Name: auth_item; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE auth_item (
    name character varying(64) NOT NULL,
    type integer NOT NULL,
    description text,
    rule_name character varying(64),
    data text,
    created_at integer,
    updated_at integer
);


ALTER TABLE auth_item OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 24739)
-- Name: auth_item_child; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE auth_item_child (
    parent character varying(64) NOT NULL,
    child character varying(64) NOT NULL
);


ALTER TABLE auth_item_child OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 24717)
-- Name: auth_rule; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE auth_rule (
    name character varying(64) NOT NULL,
    data text,
    created_at integer,
    updated_at integer
);


ALTER TABLE auth_rule OWNER TO postgres;

--
-- TOC entry 173 (class 1259 OID 24712)
-- Name: migration; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE migration (
    version character varying(180) NOT NULL,
    apply_time integer
);


ALTER TABLE migration OWNER TO postgres;

--
-- TOC entry 180 (class 1259 OID 24782)
-- Name: profile; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE profile (
    user_id integer NOT NULL,
    name character varying(255) DEFAULT NULL::character varying,
    public_email character varying(255) DEFAULT NULL::character varying,
    gravatar_email character varying(255) DEFAULT NULL::character varying,
    gravatar_id character varying(32) DEFAULT NULL::character varying,
    location character varying(255) DEFAULT NULL::character varying,
    website character varying(255) DEFAULT NULL::character varying,
    bio text,
    timezone character varying(40) DEFAULT NULL::character varying
);


ALTER TABLE profile OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 24828)
-- Name: token; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE token (
    user_id integer NOT NULL,
    code character varying(32) NOT NULL,
    created_at integer NOT NULL,
    type smallint NOT NULL
);


ALTER TABLE token OWNER TO postgres;

--
-- TOC entry 179 (class 1259 OID 24766)
-- Name: user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "user" (
    id integer NOT NULL,
    username character varying(25) NOT NULL,
    email character varying(255) NOT NULL,
    password_hash character varying(60) NOT NULL,
    auth_key character varying(32) NOT NULL,
    confirmed_at integer,
    unconfirmed_email character varying(255) DEFAULT NULL::character varying,
    blocked_at integer,
    registration_ip character varying(45),
    created_at integer NOT NULL,
    updated_at integer NOT NULL,
    flags integer DEFAULT 0 NOT NULL,
    last_login_at integer
);


ALTER TABLE "user" OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 24764)
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE user_id_seq OWNER TO postgres;

--
-- TOC entry 2132 (class 0 OID 0)
-- Dependencies: 178
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE user_id_seq OWNED BY "user".id;


--
-- TOC entry 1970 (class 2604 OID 24806)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY social_account ALTER COLUMN id SET DEFAULT nextval('account_id_seq'::regclass);


--
-- TOC entry 1960 (class 2604 OID 24769)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_id_seq'::regclass);


--
-- TOC entry 2133 (class 0 OID 0)
-- Dependencies: 181
-- Name: account_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('account_id_seq', 1, false);


--
-- TOC entry 2116 (class 0 OID 24754)
-- Dependencies: 177
-- Data for Name: auth_assignment; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2114 (class 0 OID 24725)
-- Dependencies: 175
-- Data for Name: auth_item; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2115 (class 0 OID 24739)
-- Dependencies: 176
-- Data for Name: auth_item_child; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2113 (class 0 OID 24717)
-- Dependencies: 174
-- Data for Name: auth_rule; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2112 (class 0 OID 24712)
-- Dependencies: 173
-- Data for Name: migration; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO migration (version, apply_time) VALUES ('m000000_000000_base', 1485357113);
INSERT INTO migration (version, apply_time) VALUES ('m140506_102106_rbac_init', 1485357296);
INSERT INTO migration (version, apply_time) VALUES ('m140209_132017_init', 1485358320);
INSERT INTO migration (version, apply_time) VALUES ('m140403_174025_create_account_table', 1485358320);
INSERT INTO migration (version, apply_time) VALUES ('m140504_113157_update_tables', 1485358320);
INSERT INTO migration (version, apply_time) VALUES ('m140504_130429_create_token_table', 1485358320);
INSERT INTO migration (version, apply_time) VALUES ('m140830_171933_fix_ip_field', 1485358320);
INSERT INTO migration (version, apply_time) VALUES ('m140830_172703_change_account_table_name', 1485358320);
INSERT INTO migration (version, apply_time) VALUES ('m141222_110026_update_ip_field', 1485358320);
INSERT INTO migration (version, apply_time) VALUES ('m141222_135246_alter_username_length', 1485358320);
INSERT INTO migration (version, apply_time) VALUES ('m150614_103145_update_social_account_table', 1485358320);
INSERT INTO migration (version, apply_time) VALUES ('m150623_212711_fix_username_notnull', 1485358320);
INSERT INTO migration (version, apply_time) VALUES ('m151218_234654_add_timezone_to_profile', 1485358320);
INSERT INTO migration (version, apply_time) VALUES ('m160929_103127_add_last_login_at_to_user_table', 1485358321);


--
-- TOC entry 2119 (class 0 OID 24782)
-- Dependencies: 180
-- Data for Name: profile; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO profile (user_id, name, public_email, gravatar_email, gravatar_id, location, website, bio, timezone) VALUES (1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);


--
-- TOC entry 2121 (class 0 OID 24803)
-- Dependencies: 182
-- Data for Name: social_account; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2122 (class 0 OID 24828)
-- Dependencies: 183
-- Data for Name: token; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO token (user_id, code, created_at, type) VALUES (1, 'v2DY_nstEnALQKtRHcx9I5ua2JzwjYcN', 1485358873, 0);


--
-- TOC entry 2118 (class 0 OID 24766)
-- Dependencies: 179
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "user" (id, username, email, password_hash, auth_key, confirmed_at, unconfirmed_email, blocked_at, registration_ip, created_at, updated_at, flags, last_login_at) VALUES (1, 'victor.leite', 'victor.leite@inmet.gov.br', '$2y$10$0XU8ILb13GAU5cALiH85le9mluknHxyol/ufcJl39k5yl6Cr9AHZ6', 'FwZpNWq529edBGXBOdWkawnuCgyhJShJ', 1485358873, NULL, NULL, '192.168.97.141', 1485358873, 1485358873, 0, 1485538328);


--
-- TOC entry 2134 (class 0 OID 0)
-- Dependencies: 178
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('user_id_seq', 1, true);


--
-- TOC entry 1992 (class 2606 OID 24811)
-- Name: account_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY social_account
    ADD CONSTRAINT account_pkey PRIMARY KEY (id);


--
-- TOC entry 1984 (class 2606 OID 24758)
-- Name: auth_assignment_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY auth_assignment
    ADD CONSTRAINT auth_assignment_pkey PRIMARY KEY (item_name, user_id);


--
-- TOC entry 1982 (class 2606 OID 24743)
-- Name: auth_item_child_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY auth_item_child
    ADD CONSTRAINT auth_item_child_pkey PRIMARY KEY (parent, child);


--
-- TOC entry 1979 (class 2606 OID 24732)
-- Name: auth_item_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY auth_item
    ADD CONSTRAINT auth_item_pkey PRIMARY KEY (name);


--
-- TOC entry 1977 (class 2606 OID 24724)
-- Name: auth_rule_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY auth_rule
    ADD CONSTRAINT auth_rule_pkey PRIMARY KEY (name);


--
-- TOC entry 1975 (class 2606 OID 24716)
-- Name: migration_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);


--
-- TOC entry 1990 (class 2606 OID 24795)
-- Name: profile_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY profile
    ADD CONSTRAINT profile_pkey PRIMARY KEY (user_id);


--
-- TOC entry 1986 (class 2606 OID 24777)
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- TOC entry 1993 (class 1259 OID 24812)
-- Name: account_unique; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX account_unique ON social_account USING btree (provider, client_id);


--
-- TOC entry 1994 (class 1259 OID 24882)
-- Name: account_unique_code; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX account_unique_code ON social_account USING btree (code);


--
-- TOC entry 1980 (class 1259 OID 24738)
-- Name: idx-auth_item-type; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "idx-auth_item-type" ON auth_item USING btree (type);


--
-- TOC entry 1995 (class 1259 OID 24831)
-- Name: token_unique; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX token_unique ON token USING btree (user_id, code, type);


--
-- TOC entry 1987 (class 1259 OID 24779)
-- Name: user_unique_email; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX user_unique_email ON "user" USING btree (email);


--
-- TOC entry 1988 (class 1259 OID 24778)
-- Name: user_unique_username; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX user_unique_username ON "user" USING btree (username);


--
-- TOC entry 1999 (class 2606 OID 24759)
-- Name: auth_assignment_item_name_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY auth_assignment
    ADD CONSTRAINT auth_assignment_item_name_fkey FOREIGN KEY (item_name) REFERENCES auth_item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 1998 (class 2606 OID 24749)
-- Name: auth_item_child_child_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY auth_item_child
    ADD CONSTRAINT auth_item_child_child_fkey FOREIGN KEY (child) REFERENCES auth_item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 1997 (class 2606 OID 24744)
-- Name: auth_item_child_parent_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY auth_item_child
    ADD CONSTRAINT auth_item_child_parent_fkey FOREIGN KEY (parent) REFERENCES auth_item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 1996 (class 2606 OID 24733)
-- Name: auth_item_rule_name_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY auth_item
    ADD CONSTRAINT auth_item_rule_name_fkey FOREIGN KEY (rule_name) REFERENCES auth_rule(name) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- TOC entry 2001 (class 2606 OID 24813)
-- Name: fk_user_account; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY social_account
    ADD CONSTRAINT fk_user_account FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- TOC entry 2000 (class 2606 OID 24796)
-- Name: fk_user_profile; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY profile
    ADD CONSTRAINT fk_user_profile FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- TOC entry 2002 (class 2606 OID 24832)
-- Name: fk_user_token; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY token
    ADD CONSTRAINT fk_user_token FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- TOC entry 2129 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2017-01-30 16:57:58 BRST

--
-- PostgreSQL database dump complete
--

