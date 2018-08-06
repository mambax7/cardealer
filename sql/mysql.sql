#
# Structure table for `cardealer_customer` (3 fields)
#

CREATE TABLE `cardealer_customer` (
  `custnum`  INT(11)     NOT NULL  AUTO_INCREMENT,
  `custname` VARCHAR(45) NULL,
  `custaddr` TEXT        NULL,
  PRIMARY KEY (`custnum`)
)
  ENGINE = MyISAM;
#
# Structure table for `cardealer_part` (6 fields)
#

CREATE TABLE `cardealer_part` (
  `partnum`     INT(11)      NOT NULL  AUTO_INCREMENT,
  `price`       INT(11)      NOT NULL  DEFAULT 0,
  `stock`       INT(11)      NOT NULL  DEFAULT 0,
  `title`       VARCHAR(100) NOT NULL  DEFAULT ' ',
  `description` INT          NOT NULL  DEFAULT 0,
  `picture`     VARCHAR(50)  NOT NULL  DEFAULT ' ',
  PRIMARY KEY (`partnum`)
)
  ENGINE = MyISAM;
#
# Structure table for `cardealer_service` (4 fields)
#

CREATE TABLE `cardealer_service` (
  `itemnum`     INT(11)      NOT NULL  AUTO_INCREMENT,
  `labor`       INT(11)      NULL,
  `title`       VARCHAR(100) NULL,
  `description` TEXT         NOT NULL,
  PRIMARY KEY (`itemnum`)
)
  ENGINE = MyISAM;
#
# Structure table for `cardealer_servpart` (4 fields)
#

CREATE TABLE `cardealer_servpart` (
  `id`       INT(11) NOT NULL  AUTO_INCREMENT,
  `partnum`  INT(11) NULL,
  `itemnum`  INT(11) NULL,
  `quantity` INT     NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM;
#
# Structure table for `cardealer_vehicle` (7 fields)
#

CREATE TABLE `cardealer_vehicle` (
  `id`        INT(11)      NOT NULL  AUTO_INCREMENT,
  `custnum`   INT(11)      NULL,
  `make`      VARCHAR(45)  NULL,
  `model`     VARCHAR(45)  NULL,
  `year`      INT(11)      NULL,
  `pictures`  VARCHAR(100) NULL,
  `serialnum` INT          NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM;
#
# Structure table for `cardealer_workorder` (6 fields)
#

CREATE TABLE `cardealer_workorder` (
  `id`        INT(11)    NOT NULL  AUTO_INCREMENT,
  `custnum`   INT        NULL      DEFAULT 0,
  `carnum`    INT        NULL      DEFAULT 0,
  `cost`      INT        NULL      DEFAULT 0,
  `orderdate` DATETIME   NULL      DEFAULT CURRENT_TIMESTAMP
  ON UPDATE CURRENT_TIMESTAMP,
  `status`    TINYINT(1) NULL      DEFAULT 0,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM;
#
# Structure table for `cardealer_workserv` (3 fields)
#

CREATE TABLE `cardealer_workserv` (
  `id`       INT(11) NOT NULL  AUTO_INCREMENT,
  `ordernum` INT(11) NULL,
  `itemnum`  INT(11) NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM;