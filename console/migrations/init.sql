--
-- PostgreSQL database dump
--

-- Dumped from database version 9.4.8
-- Dumped by pg_dump version 9.4.8
-- Started on 2017-05-15 16:34:37 BRT

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
-- TOC entry 2173 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 181 (class 1259 OID 57517)
-- Name: auth_assignment; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE auth_assignment (
    item_name character varying(64) NOT NULL,
    user_id character varying(64) NOT NULL,
    created_at integer
);


ALTER TABLE auth_assignment OWNER TO postgres;

--
-- TOC entry 179 (class 1259 OID 57488)
-- Name: auth_item; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE auth_item (
    name character varying(64) NOT NULL,
    type smallint NOT NULL,
    description text,
    rule_name character varying(64),
    data bytea,
    created_at integer,
    updated_at integer
);


ALTER TABLE auth_item OWNER TO postgres;

--
-- TOC entry 180 (class 1259 OID 57502)
-- Name: auth_item_child; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE auth_item_child (
    parent character varying(64) NOT NULL,
    child character varying(64) NOT NULL
);


ALTER TABLE auth_item_child OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 57480)
-- Name: auth_rule; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE auth_rule (
    name character varying(64) NOT NULL,
    data bytea,
    created_at integer,
    updated_at integer
);


ALTER TABLE auth_rule OWNER TO postgres;

--
-- TOC entry 177 (class 1259 OID 57466)
-- Name: menu; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE menu (
    id integer NOT NULL,
    name character varying(128) NOT NULL,
    parent integer,
    route character varying(256),
    "order" integer,
    data text
);


ALTER TABLE menu OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 57464)
-- Name: menu_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE menu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE menu_id_seq OWNER TO postgres;

--
-- TOC entry 2174 (class 0 OID 0)
-- Dependencies: 176
-- Name: menu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE menu_id_seq OWNED BY menu.id;


--
-- TOC entry 173 (class 1259 OID 49443)
-- Name: migration; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE migration (
    version character varying(180) NOT NULL,
    apply_time integer
);


ALTER TABLE migration OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 65666)
-- Name: oauth_access_tokens; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE oauth_access_tokens (
    access_token character varying(40) NOT NULL,
    client_id character varying(32) NOT NULL,
    user_id integer,
    expires timestamp(0) without time zone DEFAULT '2017-05-15 18:03:37.370174'::timestamp without time zone NOT NULL,
    scope character varying(2000) DEFAULT NULL::character varying
);


ALTER TABLE oauth_access_tokens OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 65696)
-- Name: oauth_authorization_codes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE oauth_authorization_codes (
    authorization_code character varying(40) NOT NULL,
    client_id character varying(32) NOT NULL,
    user_id integer,
    redirect_uri character varying(1000) NOT NULL,
    expires timestamp(0) without time zone DEFAULT '2017-05-15 18:03:37.370174'::timestamp without time zone NOT NULL,
    scope character varying(2000) DEFAULT NULL::character varying
);


ALTER TABLE oauth_authorization_codes OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 65656)
-- Name: oauth_clients; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE oauth_clients (
    client_id character varying(32) NOT NULL,
    client_secret character varying(32) DEFAULT NULL::character varying,
    redirect_uri character varying(1000) NOT NULL,
    grant_types character varying(100) NOT NULL,
    scope character varying(2000) DEFAULT NULL::character varying,
    user_id integer
);


ALTER TABLE oauth_clients OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 65717)
-- Name: oauth_jwt; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE oauth_jwt (
    client_id character varying(32) NOT NULL,
    subject character varying(80) DEFAULT NULL::character varying,
    public_key character varying(2000) DEFAULT NULL::character varying
);


ALTER TABLE oauth_jwt OWNER TO postgres;

--
-- TOC entry 188 (class 1259 OID 65738)
-- Name: oauth_public_keys; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE oauth_public_keys (
    client_id character varying(255) NOT NULL,
    public_key character varying(2000) DEFAULT NULL::character varying,
    private_key character varying(2000) DEFAULT NULL::character varying,
    encryption_algorithm character varying(100) DEFAULT 'RS256'::character varying
);


ALTER TABLE oauth_public_keys OWNER TO postgres;

--
-- TOC entry 184 (class 1259 OID 65681)
-- Name: oauth_refresh_tokens; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE oauth_refresh_tokens (
    refresh_token character varying(40) NOT NULL,
    client_id character varying(32) NOT NULL,
    user_id integer,
    expires timestamp(0) without time zone DEFAULT '2017-05-15 18:03:37.370174'::timestamp without time zone NOT NULL,
    scope character varying(2000) DEFAULT NULL::character varying
);


ALTER TABLE oauth_refresh_tokens OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 65711)
-- Name: oauth_scopes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE oauth_scopes (
    scope character varying(2000) NOT NULL,
    is_default boolean NOT NULL
);


ALTER TABLE oauth_scopes OWNER TO postgres;

--
-- TOC entry 175 (class 1259 OID 49450)
-- Name: user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "user" (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    auth_key character varying(32) NOT NULL,
    password_hash character varying(255) NOT NULL,
    password_reset_token character varying(255),
    email character varying(255) NOT NULL,
    status smallint DEFAULT 10 NOT NULL,
    created_at integer NOT NULL,
    updated_at integer NOT NULL,
    name character varying(255)
);


ALTER TABLE "user" OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 49448)
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
-- TOC entry 2175 (class 0 OID 0)
-- Dependencies: 174
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE user_id_seq OWNED BY "user".id;


--
-- TOC entry 1988 (class 2604 OID 57469)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY menu ALTER COLUMN id SET DEFAULT nextval('menu_id_seq'::regclass);


--
-- TOC entry 1986 (class 2604 OID 49453)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_id_seq'::regclass);


--
-- TOC entry 2158 (class 0 OID 57517)
-- Dependencies: 181
-- Data for Name: auth_assignment; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO auth_assignment (item_name, user_id, created_at) VALUES ('Administrator', '1', 1493821816);
INSERT INTO auth_assignment (item_name, user_id, created_at) VALUES ('Administrator', '4', 1493928838);


--
-- TOC entry 2156 (class 0 OID 57488)
-- Dependencies: 179
-- Data for Name: auth_item; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/assignment/index', 2, NULL, NULL, NULL, 1492534819, 1492534819);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/assignment/view', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/assignment/assign', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/assignment/role-search', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/assignment/*', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/default/index', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/default/*', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/menu/index', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/menu/view', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/menu/create', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/menu/update', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/menu/delete', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/menu/*', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/permission/index', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/permission/view', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/permission/create', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/permission/update', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/permission/delete', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/permission/assign', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/permission/role-search', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/permission/*', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/role/index', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/role/view', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/role/create', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/role/update', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/role/delete', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/role/assign', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/role/role-search', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/role/*', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/route/index', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/route/create', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/route/assign', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/route/route-search', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/route/*', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/rule/index', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/rule/view', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/rule/create', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/rule/update', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/rule/delete', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/rule/*', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/*', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/gridview/export/download', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/gridview/export/*', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/gridview/*', 2, NULL, NULL, NULL, 1492534820, 1492534820);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('Coordinator', 1, NULL, NULL, NULL, 1492534931, 1492534981);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('Super Moderator', 1, NULL, NULL, NULL, 1492535013, 1492535013);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('Moderator', 1, NULL, NULL, NULL, 1492535019, 1492535019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('Operator', 1, NULL, NULL, NULL, 1492535030, 1492535030);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('User', 1, NULL, NULL, NULL, 1492535037, 1492535037);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/datecontrol/parse/convert', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/datecontrol/parse/*', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/datecontrol/*', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/treemanager/node/save', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/treemanager/node/manage', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/treemanager/node/remove', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/treemanager/node/move', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/treemanager/node/*', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/treemanager/*', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/debug/default/db-explain', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/debug/default/index', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/debug/default/view', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/debug/default/toolbar', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/debug/default/download-mail', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/debug/default/*', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/debug/*', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/gii/default/index', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/gii/default/view', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/gii/default/preview', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/gii/default/diff', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/gii/default/action', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/gii/default/*', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/gii/*', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/site/error', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/site/captcha', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/site/index', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/site/login', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/site/logout', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/site/signup', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/site/request-password-reset', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/site/reset-password', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/site/set-language', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/site/*', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/*', 2, NULL, NULL, NULL, 1493929325, 1493929325);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('Administrator', 1, NULL, NULL, NULL, 1492534839, 1494351582);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/permission/remove', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/role/remove', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/route/remove', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/route/refresh', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/user/index', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/user/view', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/user/delete', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/user/login', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/user/logout', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/user/signup', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/user/reset-password', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/user/change-password', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/user/activate', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/admin/user/*', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/user/index', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/user/view', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/user/create', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/user/update', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/user/delete', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/user/*', 2, NULL, NULL, NULL, 1494352019, 1494352019);
INSERT INTO auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('/user/signup', 2, NULL, NULL, NULL, 1494859235, 1494859235);


--
-- TOC entry 2157 (class 0 OID 57502)
-- Dependencies: 180
-- Data for Name: auth_item_child; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/assignment/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/assignment/assign');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/assignment/index');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/assignment/role-search');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/assignment/view');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/default/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/default/index');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/menu/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/menu/create');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/menu/delete');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/menu/index');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/menu/update');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/menu/view');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/permission/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/permission/assign');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/permission/create');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/permission/delete');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/permission/index');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/permission/role-search');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/permission/update');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/permission/view');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/role/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/role/assign');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/role/create');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/role/delete');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/role/index');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/role/role-search');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/role/update');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/role/view');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/route/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/route/assign');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/route/create');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/route/index');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/route/route-search');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/rule/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/rule/create');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/rule/delete');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/rule/index');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/rule/update');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/rule/view');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/gridview/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/gridview/export/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/gridview/export/download');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/datecontrol/parse/convert');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/datecontrol/parse/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/datecontrol/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/treemanager/node/save');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/treemanager/node/manage');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/treemanager/node/remove');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/treemanager/node/move');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/treemanager/node/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/treemanager/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/debug/default/db-explain');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/debug/default/index');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/debug/default/view');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/debug/default/toolbar');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/debug/default/download-mail');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/debug/default/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/debug/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/gii/default/index');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/gii/default/view');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/gii/default/preview');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/gii/default/diff');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/gii/default/action');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/gii/default/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/gii/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/site/error');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/site/captcha');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/site/index');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/site/login');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/site/logout');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/site/signup');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/site/request-password-reset');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/site/reset-password');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/site/set-language');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/site/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/assignment/revoke');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/permission/remove');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/role/remove');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/route/remove');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/route/refresh');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/user/index');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/user/view');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/user/delete');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/user/login');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/user/logout');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/user/signup');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/user/request-password-reset');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/user/reset-password');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/user/change-password');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/user/activate');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/admin/user/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/user/index');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/user/view');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/user/create');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/user/update');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/user/delete');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/user/*');
INSERT INTO auth_item_child (parent, child) VALUES ('Administrator', '/user/signup');


--
-- TOC entry 2155 (class 0 OID 57480)
-- Dependencies: 178
-- Data for Name: auth_rule; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2154 (class 0 OID 57466)
-- Dependencies: 177
-- Data for Name: menu; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2176 (class 0 OID 0)
-- Dependencies: 176
-- Name: menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('menu_id_seq', 1, false);


--
-- TOC entry 2150 (class 0 OID 49443)
-- Dependencies: 173
-- Data for Name: migration; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO migration (version, apply_time) VALUES ('m000000_000000_base', 1492458220);
INSERT INTO migration (version, apply_time) VALUES ('m130524_201442_init', 1492458223);
INSERT INTO migration (version, apply_time) VALUES ('m140602_111327_create_menu_table', 1492529897);
INSERT INTO migration (version, apply_time) VALUES ('m140506_102106_rbac_init', 1492529958);
INSERT INTO migration (version, apply_time) VALUES ('m140501_075311_add_oauth2_server', 1494867817);


--
-- TOC entry 2160 (class 0 OID 65666)
-- Dependencies: 183
-- Data for Name: oauth_access_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO oauth_access_tokens (access_token, client_id, user_id, expires, scope) VALUES ('6d3370bb9a1db06892bd38ad767433f3b5e6ff9e', 'meucliente', 4, '2017-05-16 14:43:40', 'default');


--
-- TOC entry 2162 (class 0 OID 65696)
-- Dependencies: 185
-- Data for Name: oauth_authorization_codes; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2159 (class 0 OID 65656)
-- Dependencies: 182
-- Data for Name: oauth_clients; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO oauth_clients (client_id, client_secret, redirect_uri, grant_types, scope, user_id) VALUES ('meucliente', 'minhasenha', 'http://fake/', 'client_credentials authorization_code password implicit', NULL, NULL);


--
-- TOC entry 2164 (class 0 OID 65717)
-- Dependencies: 187
-- Data for Name: oauth_jwt; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2165 (class 0 OID 65738)
-- Dependencies: 188
-- Data for Name: oauth_public_keys; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2161 (class 0 OID 65681)
-- Dependencies: 184
-- Data for Name: oauth_refresh_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO oauth_refresh_tokens (refresh_token, client_id, user_id, expires, scope) VALUES ('8e9b3719916031874ca3ccedec5caf747c722ae7', 'meucliente', 4, '2017-05-29 14:43:40', 'default');


--
-- TOC entry 2163 (class 0 OID 65711)
-- Dependencies: 186
-- Data for Name: oauth_scopes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO oauth_scopes (scope, is_default) VALUES ('default', true);
INSERT INTO oauth_scopes (scope, is_default) VALUES ('custom', false);
INSERT INTO oauth_scopes (scope, is_default) VALUES ('protected', false);


--
-- TOC entry 2152 (class 0 OID 49450)
-- Dependencies: 175
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "user" (id, username, auth_key, password_hash, password_reset_token, email, status, created_at, updated_at, name) VALUES (4, 'VictorLeite', 'HxNQpLVtluJMBGCW0oEsum7gx03X06vm', '$2y$13$BF02cSqXAX/gj/km3Z4DueWpww8r4/cu.PV0NI.6BxzHsacdrqiZu', NULL, 'victor.leite@inmet.gov.br', 10, 1493821487, 1494876212, 'Victor Ferreira Leite');


--
-- TOC entry 2177 (class 0 OID 0)
-- Dependencies: 174
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('user_id_seq', 13, true);


--
-- TOC entry 2022 (class 2606 OID 57521)
-- Name: auth_assignment_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY auth_assignment
    ADD CONSTRAINT auth_assignment_pkey PRIMARY KEY (item_name, user_id);


--
-- TOC entry 2020 (class 2606 OID 57506)
-- Name: auth_item_child_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY auth_item_child
    ADD CONSTRAINT auth_item_child_pkey PRIMARY KEY (parent, child);


--
-- TOC entry 2017 (class 2606 OID 57495)
-- Name: auth_item_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY auth_item
    ADD CONSTRAINT auth_item_pkey PRIMARY KEY (name);


--
-- TOC entry 2015 (class 2606 OID 57487)
-- Name: auth_rule_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY auth_rule
    ADD CONSTRAINT auth_rule_pkey PRIMARY KEY (name);


--
-- TOC entry 2013 (class 2606 OID 57474)
-- Name: menu_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY menu
    ADD CONSTRAINT menu_pkey PRIMARY KEY (id);


--
-- TOC entry 2003 (class 2606 OID 49447)
-- Name: migration_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);


--
-- TOC entry 2026 (class 2606 OID 65675)
-- Name: oauth_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY oauth_access_tokens
    ADD CONSTRAINT oauth_access_tokens_pkey PRIMARY KEY (access_token);


--
-- TOC entry 2030 (class 2606 OID 65705)
-- Name: oauth_authorization_codes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY oauth_authorization_codes
    ADD CONSTRAINT oauth_authorization_codes_pkey PRIMARY KEY (authorization_code);


--
-- TOC entry 2024 (class 2606 OID 65665)
-- Name: oauth_clients_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY oauth_clients
    ADD CONSTRAINT oauth_clients_pkey PRIMARY KEY (client_id);


--
-- TOC entry 2032 (class 2606 OID 65726)
-- Name: oauth_jwt_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY oauth_jwt
    ADD CONSTRAINT oauth_jwt_pkey PRIMARY KEY (client_id);


--
-- TOC entry 2028 (class 2606 OID 65690)
-- Name: oauth_refresh_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY oauth_refresh_tokens
    ADD CONSTRAINT oauth_refresh_tokens_pkey PRIMARY KEY (refresh_token);


--
-- TOC entry 2005 (class 2606 OID 49465)
-- Name: user_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_email_key UNIQUE (email);


--
-- TOC entry 2007 (class 2606 OID 49463)
-- Name: user_password_reset_token_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_password_reset_token_key UNIQUE (password_reset_token);


--
-- TOC entry 2009 (class 2606 OID 49459)
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- TOC entry 2011 (class 2606 OID 49461)
-- Name: user_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_username_key UNIQUE (username);


--
-- TOC entry 2018 (class 1259 OID 57501)
-- Name: idx-auth_item-type; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "idx-auth_item-type" ON auth_item USING btree (type);


--
-- TOC entry 2037 (class 2606 OID 57522)
-- Name: auth_assignment_item_name_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY auth_assignment
    ADD CONSTRAINT auth_assignment_item_name_fkey FOREIGN KEY (item_name) REFERENCES auth_item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2036 (class 2606 OID 57512)
-- Name: auth_item_child_child_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY auth_item_child
    ADD CONSTRAINT auth_item_child_child_fkey FOREIGN KEY (child) REFERENCES auth_item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2035 (class 2606 OID 57507)
-- Name: auth_item_child_parent_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY auth_item_child
    ADD CONSTRAINT auth_item_child_parent_fkey FOREIGN KEY (parent) REFERENCES auth_item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2034 (class 2606 OID 57496)
-- Name: auth_item_rule_name_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY auth_item
    ADD CONSTRAINT auth_item_rule_name_fkey FOREIGN KEY (rule_name) REFERENCES auth_rule(name) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- TOC entry 2033 (class 2606 OID 57475)
-- Name: menu_parent_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY menu
    ADD CONSTRAINT menu_parent_fkey FOREIGN KEY (parent) REFERENCES menu(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- TOC entry 2038 (class 2606 OID 65676)
-- Name: oauth_access_tokens_client_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY oauth_access_tokens
    ADD CONSTRAINT oauth_access_tokens_client_id_fkey FOREIGN KEY (client_id) REFERENCES oauth_clients(client_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2040 (class 2606 OID 65706)
-- Name: oauth_authorization_codes_client_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY oauth_authorization_codes
    ADD CONSTRAINT oauth_authorization_codes_client_id_fkey FOREIGN KEY (client_id) REFERENCES oauth_clients(client_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2039 (class 2606 OID 65691)
-- Name: oauth_refresh_tokens_client_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY oauth_refresh_tokens
    ADD CONSTRAINT oauth_refresh_tokens_client_id_fkey FOREIGN KEY (client_id) REFERENCES oauth_clients(client_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2172 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2017-05-15 16:34:38 BRT

--
-- PostgreSQL database dump complete
--

