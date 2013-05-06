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