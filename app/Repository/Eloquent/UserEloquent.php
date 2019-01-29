<?php
/**
 * Created by PhpStorm.
 * User: ashiqhassan95
 * Date: 28/12/2018
 * Time: 9:42 PM
 */

namespace App\Repository\Eloquent;


use App\Repository\Interfaces\IUserRepository;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserEloquent implements IUserRepository
{

    /**
     * @var User
     */
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
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
     * @param $instituteId
     * @param array $columns
     * @return Collection|mixed
     */
    public function allByInstitute($instituteId, $columns = array('*')): Collection
    {
        return $this->model::query()->where('institute_id', $instituteId)->get($columns);
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
     * @param $instituteId
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator|mixed
     */
    public function paginateByInstitute($instituteId, $perPage = 15, $columns = array('*')): LengthAwarePaginator
    {
        return $this->model::query()->where('institute_id', $instituteId)->paginate($perPage, $columns);
    }

    /**
     * @param array $attributes
     * @return User|mixed
     */
    public function create(array $attributes): User
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
     * @return User|mixed
     */
    public function find($id, $columns = array('*')): User
    {
        return $this->model::query()->find($id, $columns);
    }

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return User|mixed
     */
    public function findBy($field, $value, $columns = array('*')): User
    {
        return $this->model::query()->where($field, $value)->first($columns);
    }
}