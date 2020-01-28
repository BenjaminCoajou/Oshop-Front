# Requêtes

## récupérer les 5 catégories de la home

```sql
SELECT * FROM `category` WHERE `home_order` > 0 ORDER BY `home_order`
```

## récupérer les 5 marques du footer

```sql
SELECT * FROM `brand` WHERE `footer_order` > 0 ORDER BY `footer_order`
```

## récupérer les 5 types du footer

```sql
SELECT * FROM `type` WHERE `footer_order` > 0 ORDER BY `footer_order`
```

## récupérer les produits d'une catégorie

La jointure (`INNER JOIN`) permet de récupérer des données supplémentaires mais ne permet pas de filtrer (la plupart du temps)
La clause `WHERE` sert à faire le filtre sur la catégorie

```sql
SELECT
`product`.*,
`type`.`name` AS 'type_name'
FROM `product`
INNER JOIN `type` ON `product`.`type_id` = `type`.`id` 
WHERE `category_id` = {$categoryId}
```

## récupérer les produits d'une marque

`type.name AS 'type_name'` permet de déclarer un alias => la colonne `name` de la table `type` est renommée en `type_name` lorsqu'on récupère les résultats.

```sql
SELECT
`product`.*,
`type`.`name` AS 'type_name'
FROM `product`
INNER JOIN `type` ON `product`.`type_id` = `type`.`id` 
WHERE `brand_id` = {$brandId}
```

## récupérer les produits d'un type

```sql
SELECT 
`product`.*,
`type`.`name` AS 'type_name'
FROM `product` 
INNER JOIN `type` ON `product`.`type_id` = `type`.`id` 
WHERE `type_id` = {$typeId}
```

## récupérer un produit par son id

```sql
SELECT 
`product`.*,
`brand`.`name` AS 'brand_name'
FROM `product`
INNER JOIN `brand` ON `product`.`brand_id` = `brand`.`id` 
WHERE `product`.`id`= {$productId}
```

## récupérer une marque par son id

```sql
SELECT * FROM `brand` WHERE `id` = {$brandId}
```

## récupérer une catégorie par son id

```sql
SELECT * FROM `category` WHERE `id` = {$categoryId}
```

## récupérer un type par son id

```sql
SELECT * FROM `type` WHERE `id` = {$typeId}
```