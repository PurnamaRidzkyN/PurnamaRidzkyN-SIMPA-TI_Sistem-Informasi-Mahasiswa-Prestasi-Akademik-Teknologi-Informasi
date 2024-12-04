<?php

namespace app\models;

interface BaseSeeder
{
    public function create(): array;
    public function delete(): array;
}