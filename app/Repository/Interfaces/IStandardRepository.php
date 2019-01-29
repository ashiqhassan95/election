<?php
/**
 * Created by PhpStorm.
 * User: ashiqhassan95
 * Date: 22/12/2018
 * Time: 11:04 AM
 */

namespace App\Repository\Interfaces;

use App\Models\Standard;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface IStandardRepository
{
    /**
     * @param array $columns
     * @return Collection|mixed
     */
    public function all($columns = array('*')) : Collection;

    /**
     * @param $instituteId
     * @param array $columns
     * @return Collection|mixed
     */
    public function allByInstitute($instituteId, $columns = array('*')) : Collection;

    /**
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator|mixed
     */
    public function paginate($perPage = 15, $columns = array('*')) : LengthAwarePaginator;

    /**
     * @param $instituteId
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator|mixed
     */
    public function paginateByInstitute($instituteId, $perPage = 15, $columns = array('*')) : LengthAwarePaginator;

    /**
     * @param array $attributes
     * @return Standard|mixed
     */
    public function create(array $attributes) : Standard;

    /**
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes) : bool ;

    /**
     * @param $id
     * @return bool|mixed
     */
    public function delete($id) : bool ;

    /**
     * @param $id
     * @param array $columns
     * @return Standard|mixed
     */
    public function find($id, $columns = array('*')) : Standard;

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return Standard|mixed
     */
    public function findBy($field, $value, $columns = array('*')) : Standard;
}