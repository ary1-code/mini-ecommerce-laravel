<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Http\Requests\ProductIndexRequest;
use Illuminate\Database\Eloquent\Builder;


class ProductListHandler
{

    protected ProductIndexRequest $request;

    protected Builder $queryBuilder;


    public function __construct(ProductIndexRequest $request, Builder $queryBuilder
    )
    {
        $this->request = $request;
        $this->queryBuilder = $queryBuilder;
    }

    public function applyFilter(): void
    {

        if ($this->request->filled('exist')) {

            $this->queryBuilder->where('qty', '>', 0);

        }

        if ($this->request->filled('category_id')) {

            $categoryIds = array_keys($this->request->input('category_id'));
            $this->queryBuilder->whereIn('category_id', $categoryIds);

        }

    }

    public function applySort(): void
    {
        if ($this->request->missing('sort')) {

//            default sort
            $this->queryBuilder->orderByDesc('created_at');
            return;

        }

        $sortFromQs = $this->request->input('sort');

        switch ($sortFromQs) {

            case 'best_selling':

                $this->queryBuilder
                    ->withCount([
                        'orderItems' => function ($queryBuilder) {
                            $queryBuilder
                                ->whereHas('order', function ($queryBuilder) {
                                    $queryBuilder->where('status', '=', OrderStatus::DELIVERED);
                                });
                        }
                    ])
                    ->orderByDesc('order_items_count');
                break;
            case 'lowest':
                $this->queryBuilder->orderBy('price');
                break;
            case 'highest':
                $this->queryBuilder->orderByDesc('price');
                break;
            default:
                $this->queryBuilder->orderByDesc('created_at');
                break;
        }
    }

    public function applySearch():void
    {
        if ($this->request->missing('keyword')) {
            return;
        }

        $keyword = $this->request->input('keyword');

        $this->queryBuilder->whereAny([
            'description',
            'name',
            'name_en'
        ], 'LIKE', "%$keyword%");

    }


}
