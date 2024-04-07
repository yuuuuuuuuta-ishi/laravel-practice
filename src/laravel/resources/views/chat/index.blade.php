
@extends('layouts.app')

@section('styles')
<style>
    .chat-container {
        height: 500px;
        overflow-y: auto;
        padding: 20px;
        background-color: #f2f2f2;
        border-radius: 10px;
    }

    .chat-message {
        margin-bottom: 20px;
    }

    .chat-message.bot {
        text-align: right;
    }

    .chat-message .card {
        display: inline-block;
        text-align: left;
    }

    .chat-message.user .card {
        background-color: #007bff;
        color: #fff;
    }

    .chat-message.bot .card {
        background-color: #f2f2f2;
        color: #333;
    }
</style>
@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4 text-center">Chat</h1>
            <div class="chat-form">
                <form action="{{ route('chat.index') }}" method="GET" class="mb-4">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="source_lang">Source Language</label>
                            <select class="form-control" id="source_lang" name="source_lang">
                                <option value="en" {{ $sourceLang == 'ja' ? 'selected' : '' }}>English</option>
                                <option value="ja" {{ $sourceLang == 'en' ? 'selected' : '' }}>Japanese</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="target_lang">Target Language</label>
                            <select class="form-control" id="target_lang" name="target_lang">
                                <option value="ja" {{ $targetLang == 'en' ? 'selected' : '' }}>Japanese</option>
                                <option value="en" {{ $targetLang == 'ja' ? 'selected' : '' }}>English</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input_text">Enter Text</label>
                        <textarea class="form-control" id="input_text" name="input_text" rows="3">{{ $inputText }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Translate</button>
                </form>
            </div>

            <div class="chat-container">
                @foreach ($chatHistory as $message)
                <div class="chat-message user">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">{{ $message->input_text }}</p>
                            {{-- <p class="card-text"><small>Source: {{ $message->source_lang }} / Target: {{ $message->target_lang }}</small></p> --}}
                        </div>
                    </div>
                </div>
                <div class="chat-message bot">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">{{ $message->translated_text }}</p>
                            {{-- <p class="card-text"><small>Source: {{ $message->source_lang }} / Target: {{ $message->target_lang }}</small></p> --}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-end mt-4">
                <form action="{{ route('chat.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Clear Chat History</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
