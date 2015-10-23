-- Table: buttonusers

-- DROP TABLE buttonusers;

CREATE TABLE buttonusers
(
  id serial NOT NULL,
  group_id integer, -- Grupo al que pertenecen los botones
  buttondescr character(255), -- Detalle de objeto tipo boton
  modelname character(33), -- Nombre del Modelo en plural
  actionname character(33) NOT NULL, -- Nombre de la accion a ejecutar
  active smallint,
  CONSTRAINT bt_key PRIMARY KEY (id )
)
WITH (
  OIDS=FALSE
);
ALTER TABLE buttonusers
  OWNER TO postgres;
COMMENT ON COLUMN buttonusers.group_id IS 'Grupo al que pertenecen los botones';
COMMENT ON COLUMN buttonusers.buttondescr IS 'Detalle de objeto tipo boton';
COMMENT ON COLUMN buttonusers.modelname IS 'Nombre del Modelo en plural';
COMMENT ON COLUMN buttonusers.actionname IS 'Nombre de la accion a ejecutar';

-- Table: userbuttongets

-- DROP TABLE userbuttongets;

CREATE TABLE userbuttongets
(
  id serial NOT NULL,
  user_id integer NOT NULL,
  buttonuser_id integer NOT NULL,
  active boolean NOT NULL,
  CONSTRAINT user_button_key PRIMARY KEY (id )
)
WITH (
  OIDS=FALSE
);
ALTER TABLE userbuttongets
  OWNER TO postgres;
COMMENT ON TABLE userbuttongets
  IS 'Tabla que contiene las relaciones entre los botones y los usuarios';

