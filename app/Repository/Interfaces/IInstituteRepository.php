<?php
/**
 * Created by PhpStorm.
 * User: ashiqhassan95
 * Date: 22/12/2018
 * Time: 11:12 AM
 */

namespace App\Repository\Interfaces;

use App\Models\Institute;
use App\Repository\Eloquent\InstituteEloquent;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface IInstituteRepository
{
    /**
     * @param array $columns
     * @return Collection|mixed
     */
    public function all($columns = array('*')) : Collection;

    /**
     * @param $userId
     * @param array $columns
     * @return Collection|mixed
     */
    public function allByUser($userId, $columns = array('*')) : Collection;

    /**
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator|mixed
     */
    public function paginate($perPage = 15, $columns = array('*')) : LengthAwarePaginator;

    /**
     * @param $userId
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator|mixed
     */
    public function paginateByUser($userId, $perPage = 15, $columns = array('*')) : LengthAwarePaginator;

    /**
     * @param array $attributes
     * @return Institute|mixed
     */
    public function create(array $attributes) : Institute;

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
     * @return Institute|mixed
     */
    public function find($id, $columns = array('*')) : Institute;

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return Institute|mixed
     */
    public function findBy($field, $value, $columns = array('*')) : Institute;
}