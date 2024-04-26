-- -- @block
-- select `staff`.`id`
-- from `users`
--     inner join `staff` on `users`.`id` = `staff`.`user_id`
-- where exists (
--         select *
--         from `roles`
--             inner join `role_user` on `roles`.`id` = `role_user`.`role_id`
--         where `users`.`id` = `role_user`.`user_id`
--             and `name` = 'staff'
--     )
--     and `staff`.`id` = 1;
-- @block
-- select *
-- from `users`
--     inner join `staff` on `users`.`id` = `staff`.`user_id`
-- where exists (
--         select *
--         from `roles`
--             inner join `role_user` on `roles`.`id` = `role_user`.`role_id`
--         where `users`.`id` = `role_user`.`user_id`
--             and `name` = 'staff'
--     )
--     and exists (
--         select *
--         from `staff_roles`
--             inner join `role_staff` on `staff_roles`.`id` = `role_staff`.`staff_role_id`
--         where `staff`.`id` = `role_staff`.`staff_id`
--             and `name` = 'teaching_staff'
--     );
-- @block
-- select *
-- from `users`
-- where exists (
--         select *
--         from `roles`
--             inner join `role_user` on `roles`.`id` = `role_user`.`role_id`
--         where `users`.`id` = `role_user`.`user_id`
--             and `name` = 'admin'
--     )
--     and where exists (
--         select *
--         from `staff_roles`
--         inner join `role_staff` on `staff_roles`.`id` = `role_staff`.`staff_role_id`
--     );
-- @block
-- SELECT * FROM users WHERE id IN (1);
-- @block
-- select * from `students` where exists (select * from `users` where `students`.`user_id` = `users`.`id` and exists (select * from `schools` where `users`.`school_id` = `schools`.`id` and `id` = 1)) order by `admission_number` desc;





-- @block
User::query()
->join('staff', 'users.id', '=', 'staff.user_id')
->whereExists(function ($query) {
$query->select(DB::raw(1))
->from('roles')
->join('role_user', 'roles.id', '=', 'role_user.role_id')
->whereColumn('users.id', 'role_user.user_id')
->where('name', 'staff');
})
->whereExists(function ($query) {
$query->select(DB::raw(1))
->from('staff_roles')
->join('role_staff', 'staff_roles.id', '=', 'role_staff.staff_role_id')
->whereColumn('staff.id', 'role_staff.staff_id')
->where('name', 'teaching_staff');
})
->get()
->pluck('full_name', 'id')