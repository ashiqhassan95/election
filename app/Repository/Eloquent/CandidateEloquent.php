<?php
/**
 * Created by PhpStorm.
 * User: ashiqhassan95
 * Date: 22/12/2018
 * Time: 11:14 AM
 */

namespace App\Repository\Eloquent;

use App\Models\Candidate;
use App\Repository\Interfaces\ICandidateRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CandidateEloquent implements ICandidateRepository
{
    /**
     * @var Candidate
     */
    protected $model;

    public function __construct(Candidate $candidate)
    {
        $this->model = $candidate;
    }

    /**
     * @inheritDoc
     */
    public function all($with = null, $columns = array('*')): Collection
    {
        return $this->model::with($with)->get($columns);
    }


    /**
     * @inheritDoc
     */
    public function allByInstitute($instituteId, $with = null, $columns = array('*')): Collection
    {
        $query = $this->model::query()->where('institute_id', $instituteId);
        if ($with)
            $query = $query->with($with);
        return $query->get($columns);
    }


    /**
     * @inheritDoc
     */
    public function paginate($with = null, $perPage = 15, $columns = array('*')): LengthAwarePaginator
    {
        $query = $this->model::query();
        if($with)
            $query = $query->with($with);
        return $query->paginate($perPage, $columns);
    }

    /**
     * @inheritDoc
     */
    public function paginateByInstitute($instituteId, $with = null, $perPage = 15, $columns = array('*')): LengthAwarePaginator
    {
        $query = $this->model::query()->where('institute_id', $instituteId);
        if ($with)
            $query = $query->with($with);
        return $query->paginate($perPage, $columns);
    }


    /**
     * @param array $attributes
     * @return Candidate|mixed
     */
    public function create(array $attributes): Candidate
    {
        return $this->model::query()
            ->create($attributes);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes): bool
    {
        return $this->model::query()
            ->where('id', $id)
            ->update($attributes);
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function delete($id): bool
    {
        return $this->model::query()
            ->where('id', $id)
            ->delete();
    }

    /**
     * @param $id
     * @param null $with
     * @param array $columns
     * @return Candidate|mixed
     */
    public function find($id, $with = null, $columns = array('*')): Candidate
    {
        $query = $this->model::query();
        if ($with)
            $query = $query->with($with);
        return $query->find($id, $columns);
    }

    /**
     * @param $field
     * @param $value
     * @param null $with
     * @param array $columns
     * @return Candidate|mixed
     */
    public function findBy($field, $value, $with = null, $columns = array('*')): Candidate
    {
        $query = $this->model::query()->where($field, $value);
        if ($with)
            $query = $query->with($with);
        return $query->first($columns);
    }
}