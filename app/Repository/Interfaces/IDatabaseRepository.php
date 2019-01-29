<?php
/**
 * Created by PhpStorm.
 * User: ashiqhassan95
 * Date: 25/12/2018
 * Time: 8:54 AM
 */

namespace App\Repository\Interfaces;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IDatabaseRepository
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
     * @return Model|mixed
     */
    public function create(array $attributes) : Model;

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
     * @return Model|mixed
     */
    public function find($id, $columns = array('*')) : Model;

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return Model|mixed
     */
    public function findBy($field, $value, $columns = array('*')) : Model;
}