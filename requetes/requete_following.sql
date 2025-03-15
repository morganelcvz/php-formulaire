SELECT user_id, user_pseudo, COUNT(fav_id) as favorites FROM 76_favorites
NATURAL JOIN 76_users 
GROUP BY user_id, user_pseudo
WHERE user_id = 11