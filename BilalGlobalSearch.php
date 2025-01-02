<?php

namespace App\Filament\GlobalSearch;

use Filament\Facades\Filament;
use Filament\GlobalSearch\Contracts\GlobalSearchProvider;
use Filament\GlobalSearch\GlobalSearchResult;
use Filament\GlobalSearch\GlobalSearchResults;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;

class PersonalizedGlobalSearchProvider implements GlobalSearchProvider
{
    public ?string $search = '';

    public function getResults(string $query): ?GlobalSearchResults
    {
        $builder = GlobalSearchResults::make();
  // write here all the model name with priority wise.
        $categoryOrder = [
                'Properties',
                'Units',
                'tenancies',
                'Work Orders',
                'certificates',
                'notices',
                'Tasks',
                'Inventories',
                'Keys',
                'Documents',
                'rent reviews',
                'my-jobs',
                'Contacts',
                'Contractors',
                'banks',
                'councils',
        ];

        $totalResultsCount = 0;

        $allResults = [];

        foreach (Filament::getResources() as $resource) {
            if (!$resource::canGloballySearch()) {
                continue;
            }
            $resourceResults = $resource::getGlobalSearchResults($query);

            if ($resourceResults->count()) {
                $categoryLabel = $resource::getPluralModelLabel();

                $allResults[$categoryLabel] = $resourceResults;

                $totalResultsCount += $resourceResults->count();
            }
        }

        $allResultsCategory = new \Filament\GlobalSearch\GlobalSearchResult(
            'Total '.$totalResultsCount.' Results are found','#',[''],[]
        );

        $builder->category('', collect([$allResultsCategory]));

        foreach ($categoryOrder as $category) {
            if (isset($allResults[$category])) {
                $builder->category($category, $allResults[$category]);
            }
        }

        return $builder;
    }


}
