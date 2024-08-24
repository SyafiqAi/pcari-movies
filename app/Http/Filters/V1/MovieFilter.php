<?php

namespace App\Http\Filters\V1;

use Illuminate\Http\Request;

class MovieFilter
{
    protected $allowedParams = [
        'genre'
    ];

    public function transform(Request $request)
    {
        $eloQuery = [];

        $params = $this->allowedParams;
        foreach ($params as $param) {
            $query = $request->query($param);
            $eloQuery[] = [$param, '=', $query];
        }

        return $eloQuery;
    }
}
