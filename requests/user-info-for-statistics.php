<?
   $user_info_query = pg_query("SELECT 
                                       g.uuid            as gender_uuid, -- 0
                                       cc.uuid           as city_uuid, -- 1
                                       c.uuid            as country_uuid -- 2
                                FROM users               AS u 
                                     LEFT JOIN genders   AS g  
                                            ON g.uuid = u.gender
                                     LEFT JOIN countries AS c  
                                            ON c.uuid = u.country_uuid
                                     LEFT JOIN cities    AS cc 
                                            ON cc.uuid = u.city_uuid
                                WHERE u.uuid='{$user_uuid}'") 
                      or trigger_error(pg_last_error().$user_info_query);

   if($user_info_result = pg_fetch_row($user_info_query))
   {
     $user_gender_uuid = $user_info_result[0];
     $user_country_uuid = $user_info_result[2];
     $user_city_uuid = $user_info_result[1];
   }
?>