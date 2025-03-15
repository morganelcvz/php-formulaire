SELECT 76_users.user_id, 76_users.user_pseudo, COUNT(76_posts.post_id) AS posts
FROM 76_users
LEFT JOIN 76_posts ON 76_users.user_id = 76_posts.user_id
WHERE 76_users.user_id = 12
