<?php
//(column1, column2, column3,...) VALUES (value1, value2, value3,...)
$query = "INSERT INTO user (uid, name, username, pic_square, profile_update_time, birthday_date, sex, hometown_location_id, relationship_status, significant_other_id, religion, political, activities, interests, current_location_id, is_app_user, quotes, about_me, wall_count, locale, profile_url, work_ids, education_ids, languages_ids, friend_count, can_post, languages_names) VALUES(";
$values = "";
for($i = 1 ; $i <= 27; $i++ ) 
{
	$values = $values."$".$i.", ";
}
echo $query_final = $query.$values.")"
?>