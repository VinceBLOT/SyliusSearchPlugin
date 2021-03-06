<?php

declare(strict_types=1);

namespace MonsieurBiz\SyliusSearchPlugin\Helper;

class FilterHelper
{
    const MAIN_TAXON_FILTER = 'main_taxon';
    const TAXON_FILTER = 'taxon';
    const PRICE_FILTER = 'price';

    /**
     * Return an array with filters for query
     *
     * @param array $appliedFilters
     * @return array
     */
    public static function buildFilters(array $appliedFilters): array
    {
        if (empty($appliedFilters)) {
            return [];
        }

        $filters = [];
        foreach ($appliedFilters as $field => $values) {
            if ($field === self::TAXON_FILTER) {
                $filters[] = self::buildTaxonFilter($values);
            } elseif ($field === self::MAIN_TAXON_FILTER) {
                $filters[] = self::buildMainTaxonFilter($values);
            } elseif ($field === self::PRICE_FILTER) {
                if (isset($values['min']) && isset($values['max'])) {
                    $filters[] = self::buildPriceFilter((int) $values['min'], (int) $values['max']);
                }
            } else {
                $filters[] = self::buildFilter($field, $values);
            }
        }

        return [
            'bool' => [
                'filter' => $filters
            ]
        ];
    }

    /**
     * Build filter array to add in query
     *
     * @param string $field
     * @param array $values
     * @return array
     */
    public static function buildFilter(string $field, array $values): array
    {
        $filterValues = [];
        foreach ($values as $value) {
            $filterValues[] = self::buildFilterValue($value);
        }

        return [
            'nested' => [
                'path' => 'attributes',
                'query' => [
                    'bool' => [
                        'must' => [
                            'match' => [
                                'attributes.code' => $field
                            ],
                        ],
                        'should' => $filterValues,
                        'minimum_should_match' => 1
                    ]
                ]
            ]
        ];
    }

    /**
     * Build filter array for taxon to add in query
     *
     * @param array $values
     * @return array
     */
    public static function buildTaxonFilter(array $values): array
    {
        $filterValues = [];
        foreach ($values as $value) {
            $filterValues[] = self::buildTaxonFilterValue($value);
        }

        return [
            'nested' => [
                'path' => 'taxon',
                'query' => [
                    'bool' => [
                        'should' => $filterValues,
                        'minimum_should_match' => 1
                    ]
                ]
            ]
        ];
    }

    /**
     * Build filter array for main taxon to add in query
     *
     * @param array $values
     * @return array
     */
    public static function buildMainTaxonFilter(array $values): array
    {
        $filterValues = [];
        foreach ($values as $value) {
            $filterValues[] = self::buildMainTaxonFilterValue($value);
        }

        return [
            'nested' => [
                'path' => 'mainTaxon',
                'query' => [
                    'bool' => [
                        'should' => $filterValues,
                        'minimum_should_match' => 1
                    ]
                ]
            ]
        ];
    }

    /**
     * Build filter array for price to add in query
     *
     * @param int $min
     * @param int $max
     * @return array
     */
    public static function buildPriceFilter(int $min, int $max): array
    {
        return [
            'nested' => [
                'path' => 'price',
                'query' => [
                    'range' => [
                        'price.value' => [
                            [
                                'gte' => $min * 100,
                                'lte' => $max * 100,
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Build filter value array to add in query
     *
     * @param string $value
     * @return array
     */
    public static function buildFilterValue(string $value): array
    {
        return [
            'term' => [
                'attributes.value.keyword' => SlugHelper::toLabel($value)
            ]
        ];
    }

    /**
     * Build filter value array to add in query
     *
     * @param string $value
     * @return array
     */
    public static function buildTaxonFilterValue(string $value): array
    {
        return [
            'term' => [
                'taxon.name' => SlugHelper::toLabel($value)
            ]
        ];
    }

    /**
     * Build filter value array to add in query
     *
     * @param string $value
     * @return array
     */
    public static function buildMainTaxonFilterValue(string $value): array
    {
        return [
            'term' => [
                'mainTaxon.name' => SlugHelper::toLabel($value)
            ]
        ];
    }
}
