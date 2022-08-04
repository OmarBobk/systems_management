<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

trait Searchable
{
    public function scopeSearch(Builder $builder,
                                string $needle,
                                string $search_field,
                                string $orderByColumn,
                                string $orderByDirection = 'asc',
                                string $sortOrder = null)
    {
//        dd(Model::getTable());
        if ($this->searchable_columns == null) {
            return null;
        }

        // $this->searchable_columns = ['id', 'code'];

        $searchableColumns = array_map(function ($column) {
            return "`products`".".`$column`";
        }, $this->searchable_columns);
        // $searchableColumns = ['`products`.`id`', '`products`.`code`'];

        $queryString = $this->buildQuery($searchableColumns, $needle);
        // $queryString = '`products`.`id` LIKE %search% OR
        //                 `products`.`code` LIKE %search% OR
        //                 `products`.`id` LIKE %keyword% OR
        //                 `products`.`code` LIKE %keyword%'
//
//        $builder->whereRaw(DBHelper::getTable($this->getTable()).".`account_id` = $accountId")
//            ->whereRaw("( $queryString )")
//            ->orderBy($orderByColumn, $orderByDirection);
//
//        if ($sortOrder) {
//            $builder->sortedBy($sortOrder);
//        }
//
//        $builder->select(array_map(function ($column) {
//            return "{$this->getTable()}.$column";
//        }, $this->return_from_search));
//
//        return $builder;
    }

    /**
     * Build a query based on the array that contains column names.
     *
     * @param  array  $array
     * @param  string  $searchTerm
     * @return string
     */
    private function buildQuery(array $array, string $searchTerm): string
    {
        // $array = ['`products`.`id`', '`products`.`code`'];
        $first = true;
        $queryString = '';
        // $searchTerms = 'search keyword';
        $searchTerms = explode(' ', $searchTerm);
        // $searchTerms = ['search', 'keyword']

        foreach ($searchTerms as $searchTerm) {
            $searchTerm = DB::connection()->getPdo()->quote('%'.$searchTerm.'%');
            // 1 => $searchTerma = '%search%';
            // 2 => $searchTerma = '%keyword%';

            foreach ($array as $column) {
                // 1.1 => $first = true;
                // 1.2 => $first = false;
                // 2.1 => $first = false;
                // 2.2 => $first = false;

                if ($first) {
                    $first = false;
                } else {
                    $queryString .= ' OR ';
                }
                $queryString .= $column.' LIKE '.$searchTerm;
                // 1.1 => $queryString = '`products`.`id` LIKE %search%'
                // 1.2 => $queryString = '`products`.`id` LIKE %search% OR `products`.`code` LIKE %search%'
                // 2.1 => $queryString = '`products`.`id` LIKE %search% OR `products`.`code` LIKE %search% OR `products`.`id` LIKE %keyword%'
                // 2.2 => $queryString = '`products`.`id` LIKE %search% OR `products`.`code` LIKE %search% OR `products`.`id` LIKE %keyword% OR `products`.`code` LIKE %keyword%'
            }
        }

        return $queryString;
    }
}
