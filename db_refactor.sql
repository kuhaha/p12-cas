-- 希望状況
SELECT s.*, e.cid, c.cname 
FROM tb_course c,tb_entry e, tb_student s
WHERE c.cid=e.cid and e.sid=s.sid;

-- 未提出者
SELECT *, 0 as cid, '未提出' as cname
FROM tb_student WHERE sid NOT IN 
 (SELECT sid FROM tb_entry);


-- 全員
CREATE VIEW vw_kibo AS
SELECT s.*, e.cid, c.cname,e.note 
FROM tb_course c,tb_entry e, tb_student s
WHERE c.cid=e.cid and e.sid=s.sid
UNION
SELECT *, 0 as cid, '未提出' as cname,null
FROM tb_student WHERE sid NOT IN 
 (SELECT sid FROM tb_entry)
 ORDER BY sid;