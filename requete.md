# Requêtes

## récupérer 5 catégories de la home
```sql
    SELECT * FROM `category` WHERE `home_order` > 0 ORDER BY `home_order`
```
## récupérer 5 marques du footer
```sql
    SELECT * FROM `brand` WHERE `footer_order` > 0 ORDER BY `footer_order`
```
## récupérer 5 types du footer
```sql
    SELECT * FROM `type` WHERE `footer_order` > 0 ORDER BY `footer_order`
```
## récupérer les produits d'une categorie
```sql
    SELECT 
    `product`.*, 
    `type`.`name` AS 'type_name'
    FROM `product` 
    INNER JOIN `type` ON `product`.`type_id` = `type`.`id`
    WHERE `category_id` = {$id}
```
## récupérer les produits d'une marque
```sql
    SELECT 
    `product`.*, 
    `type`.`name` AS 'type_name'
    FROM `product`
    INNER JOIN `type` ON `product`.`type_id` = `type`.`id` 
    WHERE `brand_id` = {$id}
```
## récupérer les produits d'un type
```sql
    SELECT
    `product`.*, 
    `type`.`name` AS 'type_name'
    FROM `product` 
    INNER JOIN `type` ON `product`.`type_id` = `type`.`id` 
    WHERE `type_id` = {$produdtId}
```
## récupérer un produit par son id
```sql
    SELECT 
    `product`.*, `brand`.`name` AS 'brand_name' 
    FROM `product` 
    INNER JOIN `brand` ON `product`.`brand_id` = `brand`.`id` 
    WHERE `product`.`id` = {$productId}
```
## récupérer un marque par son id
```sql
    SELECT * FROM `brand` WHERE `id` = {$BrandId}
```
## récupérer un categorie par son id
```sql
    SELECT * FROM `category` WHERE `id` = {$CategoryId}
```
## récupérer un type par son id
```sql
    SELECT * FROM `type` WHERE `id` = {$TypeId}
```