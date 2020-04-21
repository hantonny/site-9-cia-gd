ALTER TABLE  `#__ecard_setting` ADD  `large_width` INT NOT NULL AFTER  `height` , ADD  `thumb_width` INT NOT NULL AFTER  `large_width`;

UPDATE  `#__ecard_setting` SET  `large_width` =  '535',`thumb_width` =  '120' WHERE  `id` =1;