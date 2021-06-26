<?php

class AlbomControllerTest extends TestCase
{
    public function test_albom_controller_index_method()
    {
        $response = $this->get('/api/album')->response;

        $this->assertEquals(200, $response->getStatusCode());
    }
}
