<?php

namespace Samkaveh\Category\Repository;

use Samkaveh\Category\Models\Category;

class CategoryRepository
{

    public static function all()
    {
        return Category::all();
    }

    public function latest()
    {
        return Category::latest()->get();
    }

    public function store($values)
    {
        return Category::create($values->only('title', 'parent_id'));
    }

    public function update($item, $values)
    {
        return $item->update($values->only('title', 'parent_id'));
    }

    public function destory($item)
    {
        return $item->delete();
    }

    public function treeGruph()
    {
        return Category::where('parent_id', null)->with('subCategories')->get();
    }
}
