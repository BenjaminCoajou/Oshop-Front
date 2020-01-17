# Routes

## Sprint 1

| URL | HTTP Method | Controller | Title | Content | Comment |
|--|--|--|--|--|--|--|
| `/` | `GET`| `MainController` | `home` |Dans les shoe | 5 categories | - |
| `/legal-mentions` | `GET`| `MainController` | `legalMentions` |Mentions légales| This page contains all boring legal stuff | - |
| `/catalog/category/[i:categoryId]` | `GET` | `CatalogController` | `category` | categorie de chaussures | 5 categories | the id is dynamics with [i:catgoryId] |
| `/catalog/type/[i:typeId]` | `GET` | `CatalogController ` | `type` | Nom du type | Will display Type page [typeId]  | [typeId] in the URL represents typeId stored in database |
| `/catalog/brand/[i:brandId]` | `GET` | `CatalogController ` | `brand` | brand [brandId] | Will display Brand page [brandId]  | [] in the URL represents brandId |
| `/catalog/product/[i:productId]` | `GET` | `CatalogController ` | `product` | product [productId] | Will display Product page [productId]  | [] in the URL represents productId |


