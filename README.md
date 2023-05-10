# Console Command for scraping data:

`php artisan scrape:data {pageCount}` // *integer value or string "all" without double quotes*

##### Example:

```
php artisan scrape:data all
or
php artisan scrape:data 1
```

Parameter **{pageCount}** is required.
**{pageCount}** = number of pages to be scraped and will be based from https://sugargang.com/collections/alle-produkte. This is added to prevent maximum_execution_time php error which I am experiencing on my side when all pages are being scraped.

### Please note:
Some data are not explicitly available from the website or has inconsistencies, such as;
**Quantity** = not found/available
**Product Ingredients** = displayed not consistently
**SKU** = not found/available
