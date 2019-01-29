<?php
/**
 * Created by PhpStorm.
 * User: ashiqhassan95
 * Date: 22/12/2018
 * Time: 11:14 AM
 */

namespace App\Repository\Eloquent;

use App\Models\Institute;
use App\Repository\Interfaces\IInstituteRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class InstituteEloquent implements IInstituteRepository
{
    /**
     * @var Institute
     */
    protected $model;

    public function __construct(Institute $institute)
    {
        $this->model = $institute;
    }

    /**
     * @param array $columns
     * @return Collection|mixed
     */
    public function all($columns = array('*')): Collection
    {
        return $this->model::all($columns);
    }

    /**
     * @param $userId
     * @param array $columns
     * @return Collection|mixed
     */
    public function allByUser($userId, $columns = array('*')): Collection
    {
        return $this->model::query()->where('user_id', $userId)->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator|mixed
     */
    public function paginate($perPage = 15, $columns = array('*')): LengthAwarePaginator
    {
        return $this->model::query()->paginate($perPage, $columns);
    }

    /**
     * @param $userId
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator|mixed
     */
    public function paginateByUser($userId, $perPage = 15, $columns = array('*')): LengthAwarePaginator
    {
        return $this->model::query()->where('user_id', $userId)->paginate($perPage, $columns);
    }


    /**
     * @param array $attributes
     * @return Institute|mixed
     */
    public function create(array $attributes): Institute
    {
        return $this->model::query()->create($attributes);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes): bool
    {
        return $this->model::query()->where('id', $id)->update($attributes);
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function delete($id): bool
    {
        return $this->model::query()->where('id', $id)->delete();
    }

    /**
     * @param $id
     * @param array $columns
     * @return Institute|mixed
     */
    public function find($id, $columns = array('*')): Institute
    {
        return $this->model::query()->find($id, $columns);
    }

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return Institute|mixed
     */
    public function findBy($field, $value, $columns = array('*')): Institute
    {
        return $this->model::query()->where($field, $value)->first($columns);
    }
}