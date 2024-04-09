<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\ChatController;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatControllerTest extends TestCase
{
    /**
     * Test the index function with empty input text.
     */
    public function test_index_with_empty_input_text()
    {
        $controller = new ChatController(app()->make(\App\Services\DeeplTranslator::class), app()->make(\App\Services\A3rt::class));
        $request = new Request();

        $response = $controller->index($request);

        $this->assertEquals('en', $response->getData()['sourceLang']);
        $this->assertEquals('ja', $response->getData()['targetLang']);
        $this->assertEquals('', $response->getData()['inputText']);
        $this->assertCount(Message::count(), $response->getData()['chatHistory']);
    }

    /**
     * Test the index method with a non-empty input text.
     *
     * このテストは、ChatControllerクラスのindexメソッドが非空の入力テキストを
     * 正しく処理するかどうかを確認します。ChatControllerクラスの新しいインスタンス
     * を作成し、DeeplTranslatorクラスの新しいインスタンスをパラメーターとして
     * 渡します。その後、新しいRequestインスタンスを作成し、'source_lang'パラメーター
     * を'en'、'target_lang'パラメーターを'ja'、'input_text'パラメーターを'Hello'に
     * 設定します。ChatControllerクラスのindexメソッドを呼び出し、新しいRequest
     * インスタンスをパラメーターとして渡します。最後に、返されたレスポンスデータの
     * 'sourceLang'、'targetLang'、'inputText'、'chatHistory'プロパティが予想される
     * 値であることを確認します。
     *
     * @return void
     */
    public function test_index_with_non_empty_input_text()
    {
        // Create a new instance of the ChatController class
        $controller = new ChatController(app()->make(\App\Services\DeeplTranslator::class), app()->make(\App\Services\A3rt::class));

        // Create a new instance of the Request class with non-empty input text
        $request = new Request([
            'source_lang' => 'en',
            'target_lang' => 'ja',
            'input_text' => 'Hello'
        ]);

        // Call the index method of the ChatController class
        $response = $controller->index($request);

        // Assert the response data
        $this->assertEquals('en', $response->getData()['sourceLang']);
        $this->assertEquals('ja', $response->getData()['targetLang']);
        $this->assertEquals('Hello', $response->getData()['inputText']);
        $this->assertCount(Message::count(), $response->getData()['chatHistory']);
    }
}
