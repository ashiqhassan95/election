<?php
/**
 * Created by PhpStorm.
 * User: ashiqhassan95
 * Date: 01/12/2018
 * Time: 10:42 PM
 */

namespace App\Repository\Interfaces;

use App\Models\Candidate;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ICandidateRepository
{
    /**
     * @param null $with
     * @param array $columns
     * @return Collection|mixed
     */
    public function all($with = null, $columns = array('*')): Collection;

    /**
     * @param $instituteId
     * @param array $columns
     * @param null $with
     * @return Collection|mixed
     */
    public function allByInstitute($instituteId, $with = null, $columns = array('*')): Collection;

    /**
     * @param null $with
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator|mixed
     */
    public function paginate($with = null, $perPage = 15, $columns = array('*')): LengthAwarePaginator;

    /**
     * @param $instituteId
     * @param null $with
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator|mixed
     */
    public function paginateByInstitute($instituteId, $with = null, $perPage = 15, $columns = array('*')): LengthAwarePaginator;

    /**
     * @param array $attributes
     * @return Candidate|mixed
     */
    public function create(array $attributes): Candidate;

    /**
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes): bool;

    /**
     * @param $id
     * @return bool|mixed
     */
    public function delete($id): bool;

    /**
     * @param $id
     * @param null $with
     * @param array $columns
     * @return Candidate|mixed
     */
    public function find($id, $with = null, $columns = array('*')): Candidate;

    /**
     * @param $field
     * @param $value
     * @param null $with
     * @param array $columns
     * @return Candidate|mixed
     */
    public function findBy($field, $value, $with = null, $columns = array('*')): Candidate;
}