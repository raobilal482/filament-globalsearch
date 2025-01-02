# filament-globalsearch-customization
Filament Global Search Customization 
Customizing Global Search in Filament: Ordering and Grouping Results
Get you desired order not alphabatecally. Also show Total Results in globalsearch
To customize the global search results in Filament, you can define a custom search order and group the results by modules (for instance, alphabetically/or order you want ). This allows you to have more control over the way results are displayed and ensures that users can easily navigate through them.

Just copy and paste this file BilalGlobalSearchProvider.php in app\filament\GlobalSearch\BilalGlobalSearch.php
and then register this in admin panel in globalsearch method here
 public function panel(Panel $panel): Panel
    {
        return $panel
            ->globalSearch(BilalGlobalSearchProvider::class)
    }

    Write you own logic in this file.
    
Note: return type should be a object. Read this class in detail.

            
