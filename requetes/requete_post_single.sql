SELECT * FROM 76_posts
INNER JOIN 76_comments
ON 76_comments.post_id = 76_posts.post_id
INNER JOIN 76_users 
ON 76_users.user_id = 76_comments.user_id 
INNER JOIN 76_pictures 
ON 76_pictures.post_id = 76_posts.post_id
WHERE 76_posts.post_id = 2