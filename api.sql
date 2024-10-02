-- SELECT members.id, members.name,members.number,members.email,attendances.attending_time,attendances.attendance_fee
-- FROM members
-- JOIN attendances
-- ON members.id = attendances.member_id;

-- LEFT JOIN include all the rows in the members table

-- SELECT members.id, members.name,members.number,members.email,attendances.attending_time,attendances.attendance_fee FROM members JOIN attendances ON members.id = attendances.member_id WHERE members.id=1;

-- SELECT groups.id, groups.name, members.id, members.name, members.number, members.email, attendances.attending_time, attendances.attendance_fee
-- FROM groups
-- JOIN members ON groups.id = members.group_id
-- JOIN attendances ON members.id = attendances.member_id;


-- $sql = "SELECT `groups`.id, `groups`.name, members.id, members.name, members.number, members.email, attendances.attending_time, attendances.attendance_fee FROM `groups` JOIN members ON `groups`.id = members.group_id JOIN attendances ON members.id = attendances.member_id;";


-- SELECT `groups`.id, `groups`.name, members.id, members.name, members.number, members.email, attendances.attending_time, attendances.attendance_fee FROM `groups` JOIN members ON `groups`.id = members.group_id JOIN attendances ON members.id = attendances.member_id WHERE members.id=1;
