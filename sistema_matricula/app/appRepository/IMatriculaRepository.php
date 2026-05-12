<?php
interface IMatriculaRepository {
    public function save(array $data);
    public function find($id);
    public function delete($id);
}