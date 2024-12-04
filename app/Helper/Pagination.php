<?php
namespace App\Helper;
use Illuminate\Support\Facades\Schema;
class Pagination
{
    private $query,
    $attributes,
    $limit,
    $page,
    $tableName,
    $model;
    public function __construct($model , $query) {
        $this->model = resolve($model);
        $this->tableName = $this->model->getTable();
        $this->attributes = Schema::getColumnListing($this->tableName);
        $this->prepareCondition($query);
    }
    public function prepareCondition($query){
        
        $params = $query;
        
        $this->limit = isset($params['limit']) ? $params['limit'] : 10;
        
        $this->page = isset($params['page']) ? $params['page'] : 1;
        
        $model = $this->model;
        
        $query = $model::query();

        foreach ($params as $key => $param) {
            if(array_search($key, $this->attributes) !== false)
            {
                $query->where($key, $param);
            }
        }

        $this->query =  $query;
    }

    public function paginate(){
        $query = $this->query;
        
        $pagination = $query->paginate($this->limit)->toArray();

        return [
            "page" => $pagination["current_page"],
            $this->tableName => $pagination["data"],
            "total" => $pagination["total"],
            "limit" => $pagination["per_page"]
        ];
    }
    
    
}