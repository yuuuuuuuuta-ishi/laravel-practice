<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DeeplTranslator;

class TranslateController extends Controller
{
    private $deeplTranslator;

    /**
     * TranslateController constructor.
     *
     * Initializes a new instance of the TranslateController class.
     *
     * @param DeeplTranslator $deeplTranslator An instance of the DeeplTranslator class.
     */
    public function __construct(DeeplTranslator $deeplTranslator)
    {
        // Assign the DeeplTranslator instance to the $deeplTranslator property.
        $this->deeplTranslator = $deeplTranslator;
    }

    /**
     * Index action.
     *
     * Displays the index view for the translate controller.
     *
     * @return \Illuminate\Contracts\View\View The rendered index view.
     */
    public function index()
    {
        // Call the view helper function and return the result
        // The view helper function is responsible for rendering the index view for the translate controller.
        // The view helper function takes the name of the view file ('translate.index') as a parameter.
        // It returns an instance of the Illuminate\Contracts\View\View interface.
        $view = view('translate.index');

        // Return the rendered index view
        return $view;
    }

    public function translate(Request $request)
    {
        $text = $request->input('text');
        $sourceLang = $request->input('source_lang');
        $targetLang = $request->input('target_lang');

        $translatedText = $this->deeplTranslator->translate($text, $sourceLang, $targetLang);

        return view('translate.result', [
            'translated_text' => $translatedText
        ]);
    }
}
