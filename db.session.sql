-- select * from `users` where exists (select * from `roles` inner join `role_user` on `roles`.`id` = `role_user`.`role_id` where `users`.`id` = `role_user`.`user_id` and `name` = 'admin')

-- SELECT name FROM states
-- WHERE id = 16;

--@block
-- SELECT * FROM users WHERE id IN (1);

--@block
select * from `students` where exists (select * from `users` where `students`.`user_id` = `users`.`id` and exists (select * from `schools` where `users`.`school_id` = `schools`.`id` and `id` = 1)) order by `admission_number` desc;