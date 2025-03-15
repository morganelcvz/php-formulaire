SELECT COUNT(*) FROM 76_likes
INNER JOIN 76_posts ON 76_likes.post_id = 76_posts.post_id 
WHERE 76_posts.post_id = 2