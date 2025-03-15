SELECT 76_favorites.fav_id, COUNT(76_favorites.user_id) AS followers
FROM 76_favorites
INNER JOIN 76_users ON 76_favorites.user_id = 76_users.user_id
WHERE fav_id = 12