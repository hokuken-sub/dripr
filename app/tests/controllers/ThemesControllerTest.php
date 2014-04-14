<?php

class ThemesControllerTest extends TestCase {

    public function testShow()
    {
        $this->client->request('GET', 'api/theme/1');
        $json = json_decode($this->client->getResponse()->getContent(), true);
        $expected = [
            "error" => true,
            "message" => 'Specified Theme (ID: 1) is not Found',
            404
        ];
        $this->assertEquals($expected, $json);
    }

}
