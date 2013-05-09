please execute these sql to update db
2013-5-6 13:46:09 
update table struct
{
ALTER TABLE `post`
	ADD COLUMN `comments` INT(11) NOT NULL DEFAULT '0' AFTER `status`;
}
2013-5-6 14:17:10 
update data
{
UPDATE post SET comments = (SELECT count(*) FROM comment WHERE post_id=post.id);
}
2013-5-9 12:22:23
alter corporationo request struct
{
ALTER TABLE `corporation_request`
    ALTER `id_card_cap` DROP DEFAULT,
    ALTER `st_card_cap` DROP DEFAULT;
ALTER TABLE `corporation_request`
    CHANGE COLUMN `id_card_number` `id_card_number` TINYTEXT NULL AFTER `user_id`,
    CHANGE COLUMN `st_card_number` `st_card_number` TINYTEXT NULL AFTER `id_card_number`,
    CHANGE COLUMN `id_card_cap` `id_card_cap` VARCHAR(50) NULL AFTER `st_card_number`,
    CHANGE COLUMN `st_card_cap` `st_card_cap` VARCHAR(50) NULL AFTER `id_card_cap`;
}