<?php

// use Laravel\Lumen\Testing\DatabaseMigrations;
// use Laravel\Lumen\Testing\DatabaseTransactions;

use App\Models\BaseModel;

class BaseModelTest extends TestCase
{
    public Model $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new Model;
    }
    public function test_base_model_where_method()
    {
        $this->model->where('id', 5);
        $this->assertEquals(5, $this->model->getWhereParams()['id']);
    }
    public function test_base_model_default_endpoint()
    {
        $this->assertEquals('models', $this->model->defaultEndPoint());
    }
    public function test_base_model_get_endpoint()
    {
        $this->assertEquals($this->model->endpoint, $this->model->getEndPoint());
    }
    public function test_base_model_get_method()
    {
        $this->assertCount(4, $this->model->get());
    }
    public function test_base_model_all_method()
    {
        $this->assertCount(4, get_class($this->model)::all());
    }
}

class Model extends BaseModel
{
    public $endpoint = 'endpoint';

    public function getFileContent(): string
    {
        return '
        [
            {
              "userId": 1,
              "id": 1,
              "title": "quidem molestiae enim"
            },
            {
              "userId": 1,
              "id": 2,
              "title": "sunt qui excepturi placeat culpa"
            },
            {
              "userId": 1,
              "id": 3,
              "title": "omnis laborum odio"
            },
            {
              "userId": 1,
              "id": 4,
              "title": "non esse culpa molestiae omnis sed optio"
            }
        ]
        ';
    }
}
