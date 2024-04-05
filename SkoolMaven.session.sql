-- select * from `users` where exists (select * from `roles` inner join `role_user` on `roles`.`id` = `role_user`.`role_id` where `users`.`id` = `role_user`.`user_id` and `name` = 'admin')

-- SELECT name FROM states
-- WHERE id = 16;

--@block
SELECT * FROM users WHERE id IN (1);