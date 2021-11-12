select 
i.id,i.customer_name,i.customer_contact,i.customer_address,
i.product_id,p.product_name,i.inquiry_time,i.tag
from inquiry i,product p
where (i.product_id = p.id)
order by i.inquiry_time desc