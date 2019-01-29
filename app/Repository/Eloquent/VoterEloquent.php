<?php
/**
 * Created by PhpStorm.
 * User: ashiqhassan95
 * Date: 22/12/2018
 * Time: 11:14 AM
 */

namespace App\Repository\Eloquent;

use App\Models\Voter;
use App\Repository\Interfaces\IVoterRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class VoterEloquent implements IVoterRepository
{
    /**
     * @var Voter
     */
    protected $model;

    public function __construct(Voter $voter)
    {
        $this->model = $voter;
    }

    /**
     * @param array $columns
     * @return Collection|mixed
     */
    public function all($columns = array('*')): Collection
    {
        return $this->model::query()->latest($columns);
    }

    /**
     * @param $instituteId
     * @param array $columns
     * @return Collection|mixed
     */
    public function allByInstitute($instituteId, $columns = array('*')): Collection
    {
        return $this->model::query()
            ->with('standard')
            ->where('institute_id', $instituteId)
            ->get($columns);
    }


    /**
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator|mixed
     */
    public function paginate($perPage = 15, $columns = array('*')): LengthAwarePaginator
    {
        return $this->model::query()
            ->with('standard')
            ->paginate($perPage, $columns);
    }

    /**
     * @param $instituteId
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator|mixed
     */
    public function paginateByInstitute($instituteId, $perPage = 15, $columns = array('*')): LengthAwarePaginator
    {
        return $this->model::query()
            ->where('institute_id', $instituteId)
            ->with('standard')
            ->paginate($perPage, $columns);
    }

    /**
     * @param array $attributes
     * @return Voter|mixed
     */
    public function create(array $attributes): Voter
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
     * @return Voter|mixed
     */
    public function find($id, $columns = array('*')): Voter
    {
        return $this->model::query()->find($id, $columns);
    }

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return Voter|mixed
     */
    public function findBy($field, $value, $columns = array('*')): Voter
    {
        return $this->model::query()->where($field, $value)->first($columns);
    }
}