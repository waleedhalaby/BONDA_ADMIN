INSERT INTO `product_categories`(`CATEGORY`, `IS_ACTIVE`) VALUES
  ('Bracelets','1'),
  ('Watches','1'),
  ('Earrings','1'),
  ('Rings','1'),
  ('Necklace','1'),
  ('Statements Necklaces','1');

INSERT INTO `products`(`SKU_ID`, `NAME`, `PRICE`, `CURRENCY_ID`, `DESCRIPTION`, `CATEGORY_ID`) VALUES
('#4KJ1LM9O','Gemstone Onyx','9.99','1','Handmade item, Bead Material: Gemstone, for him','27'),
('#6YI0FRLC','Swarovski pearls','11.99','1','hammered brass link chain, peach pink resin flower, Materials: brass leaf, for her','27'),
('#77IEQ2WE','CASIO G-SHOCK MT-G','1503.49','1','GPS HYBRID WAVE CEPTOR MTG-G1000SG-1AJF MENS JAPAN IMPORT, for him','28'),
('#8EP00VMC','Brushed Silver Mesh','119.00','1','for her','28'),
('#7ER9MNOW','LIVE SHOW GOLD EARRINGS LULUS','12.19','1','Take the Live Show Gold Earrings out for a night on the town! These unique antiqued gold earrings have swirling, engraved accents. Earrings measure 2" long.','29'),
('#3RRIVN90','Metallic Silver Triangle Invisible','21.88','1','Dangle Geometric Clip Earrings, Non Pierced Earrings, Minimalist Clip-ons, Gift For Her','29'),
('#5RR9FKAN','Angel Wings Ring','5.99','1','Boho Rings, Angel Jewelry, Solid 925 Sterling Silver RIng, Christmas Gift for Women, Silver Rings, Custom Rings, Initials','30'),
('#EISN33OL','Rainbow Moonstone Ring','8.99','1','Boho Ring, Moon Ring, Gypsy Ring, Statement Rings, Solid 925 Sterling Silver Rings, Don Biu','30'),
('#VB6EOLAM','AURIFEROUS NEST RING','4.99','1','Three times around','30'),
('#QIO0REMA','Geometric marble pendant on gold chain','14.49','1','This would look so pretty layered with other necklaces. Drop is 16” Colors available: white square, white rectangle, black rectangle, green rectangle','31'),
('#14FMQOAK','Gold & Iridescent Rhinestone Statement Necklace','29.49','1','Women\'s Statement Jewellery, handmade item','32');

INSERT INTO product_feature_values (PRODUCT_ID,FEATURE_ID,VALUE) VALUES
  ('10145','22',NULL),
  ('10146','22',NULL),
  ('10147','22',NULL),
  ('10148','22',NULL),
  ('10149','22',NULL),
  ('10150','22',NULL),
  ('10151','22',NULL),
  ('10152','22',NULL),
  ('10153','22',NULL),
  ('10154','22',NULL),
  ('10155','22',NULL);

INSERT INTO products_images (PRODUCT_ID,IMAGE_PATH) VALUES
  ('10145','Assets/77d14787c43f17fc9b83bff1c0df472a.jpg'),
  ('10146','Assets/e1b43693aac195ea04fd81da9c54c29c.jpg'),
  ('10146','Assets/il_570xN.483022612_fmxe.jpg'),
  ('10147','Assets/51cBsznlwJL.jpg'),
  ('10148','Assets/joy_brushed_silver_mesjh.jpg'),
  ('10150','Assets/il_570xN.1152836979_2avt.jpg'),
  ('10151','Assets/il_570xN.1061071384_twd7.jpg'),
  ('10152','Assets/8a4f86de23d2c6130781b21e064e9729.jpg'),
  ('10152','Assets/il_570xN.697704988_sx3m.jpg'),
  ('10153','Assets/6ead3e2d9b3876a54710ff2a05895bfa.jpg'),
  ('10155','Assets/il_570xN.1300891573_5gnl.jpg');
